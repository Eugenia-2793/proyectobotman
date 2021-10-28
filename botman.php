<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\SymfonyCache;
use BotMan\BotMan\Drivers\DriverManager;

require_once('Clases/Hablar.php');
require_once('Clases/Ayuda.php');
require_once('Clases/Ejercicios.php');
require_once('Clases/Comando.php');

DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

$adapter = new FilesystemAdapter();
$config = [];
$botman = BotManFactory::create($config, new SymfonyCache($adapter));

//Si no coincide con ningun 'hears' entra en fallback
$botman->fallback(function ($bot) {
    $mensaje = $bot->getMessage(); //obtenemos el objeto mensaje del usuario
    $bot->reply('No comprendo \'' . $mensaje->getText() . '\', sea más específico');  // respuesta al usuario
});

//hears: para escuchar lo que dice el usuario y compararlo con el primer parametro
$botman->hears('hola(.*)|buen(.*)', function ($bot) {
    $mensaje = $bot->getMessage();
    if (preg_match("/como estas/", $mensaje->getText())) {
        $bot->reply('gracias por preguntarme');
    }
    //startConversation da a la clase para que responda Ej Hablar
    $bot->startConversation(new Hablar());
});

//---------------------------------AYUDA
$botman->hears(
    '(.*)ayuda(.*)|(.*)no ent(.*)|(.*)no se(.*)|(.*)guiar(.*)',
    function ($bot) {
        $bot->startConversation(new Ayuda());
    }
)->skipsConversation();
/*skipsConversation  se realiza un salto a ese llamado y al finalizar
    continua en donde se encontraba antes de la coincidencia*/


//--------------------------------TRABAJOS PRACTICOS
$botman->hears(
    '(.*)ejercicios(.*)|(.*)tp(.*)|(.*)pwd(.*)',
    function ($bot) { 
        $bot->startConversation(new Ejercicios());
    }
);

//--------------------------------COMANDOS
$botman->hears(
    '(.*)comandos(.*)|(.*)git(.*)',
    function ($bot) { 
        $bot->startConversation(new Comandos());
    }
);

//--------------------------------SALIR
$botman->hears('(.*)chau(.*)|me voy(.*)|adios(.*)|nos vemos(.*)|gracias|nada', function ($bot) {
    $bot->reply('Un placer, hasta pronto!');
})->stopsConversation();
/*stopConversation, realiza un salto a este llamado y se detiende el hilo de conversacion*/

//--------------------------------ESCUCHAR RESPUESTA
$botman->listen();
//listen: es para que botman este atento a los ingresos de mensaje