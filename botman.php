<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\SymfonyCache;
use BotMan\BotMan\Drivers\DriverManager;

require_once('Hablar.php');
require_once('Ayuda.php');
require_once('Ejercicios.php');
require_once('Comando.php');

DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

$adapter = new FilesystemAdapter();
$config = [];
$botman = BotManFactory::create($config, new SymfonyCache($adapter));

$botman->fallback(function ($bot) {
    $mensaje = $bot->getMessage();
    $bot->reply('No comprendo \'' . $mensaje->getText() . '\', sea más específico');
});

//hears es para escuchar lo que dice el usuario y compararlo con el primer parametro
$botman->hears('hola(.*)|buen(.*)', function ($bot) { 
    $mensaje = $bot->getMessage();
    if (preg_match("/como estas/", $mensaje->getText())) {
        $bot->reply('gracias por preguntarme');
    }
    //startConversation da la responsabilidad a la clase que se encuentra en el parametro para que responda
   $bot->startConversation(new Hablar());
});

//---------------------------------AYUDA
$botman->hears('(.*)ayuda(.*)|(.*)no ent(.*)|(.*)no se(.*)|(.*)guiar(.*)', 
   function ($bot) {
   $bot->startConversation(new Ayuda());
})->skipsConversation();

//--------------------------------TRABAJOS PRACTICOS
$botman->hears('(.*)ejercicios(.*)|(.*)tp(.*)|(.*)pwd(.*)', 
function ($bot) { //por aca ingresa el texto del usuario
  $bot->startConversation(new Ejercicios());
});

//--------------------------------COMANDOS
$botman->hears('(.*)comandos(.*)|(.*)git(.*)', 
function ($bot) { //por aca ingresa el texto del usuario
 $bot->startConversation(new Comandos());
});

//--------------------------------SALIR
$botman->hears('(.*)chau(.*)|me voy(.*)|adios(.*)|nos vemos(.*)|gracias|nada', function ($bot) {
    $bot->reply('Un placer, hasta pronto!');
})->stopsConversation();
/*stopConversation, realiza un salto a este llamado sin importar donde este pero
la diferencia es que se detiende el hilo de conversacion*/


//--------------------------------ESCUCHAR RESPUESTA
$botman->listen();