<?php

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class Ejercicios extends Conversation
{

    /**
     * creamos un obj pregunta, obj pregunta contiene objetos botones,
     * preguntamos si la respuesta fue de forma interactiva (en este caso si respondio por botones)
     * y sino le insistimos que responda con botones, si es interactiva leemos el valor de la respuesta 
     * y le damos intrucciones, para href si no usamos target='_blank' se carga la pagina dentro del chat, probar jaja
     */
    public function run()
    {
        //creamos una pregunta que contendra botones
        $preguntas = Question::create('TPs de PWD')
            ->addButtons([ //arreglo de los botones de opciones
                Button::create('1 - MVC')->value('mvc'),
                Button::create('2 - Bootstrap ')->value('bt'),
                Button::create('3 - Files ')->value('files'),
                Button::create('4 - ORM - ABM')->value('ormabm'),
                Button::create('5 - Sessions and Cookies')->value('syc'),
            ]);
        $this->ask($preguntas, function ($answer) {
            //pregunta a traves de los botones y el usuario responde
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() == 'mvc') {
                    $this->say('Trabajo práctico Nro1 (Modelo/Vista/Control) <a href=\'http://localhost/PWD2021/TP1/vista/tp1/1/ejer1TP1.php\' target="_blank">ver</a>');
                } elseif ($answer->getValue() == 'bt') {
                    $this->say('Trabajo práctico Nro2 (Bootstrap) <a href=\'http://localhost/PWD2021/TP1/vista/tp2/3/ejer3TP2.php\' target="_blank">ver</a>');
                } elseif ($answer->getValue() == 'files') {
                    $this->say('Trabajo práctico Nro3 (Subir Aarchivos) <a href=\'http://localhost/PWD2021/TP1/vista/tp3/1/ejer1TP3.php\' target="_blank">ver</a>');
                } elseif ($answer->getValue() == 'ormabm') {
                    $this->say('Trabajo práctico Nro4 (ORM - ABM) <a href=\'http://localhost/PWD2021/TP1/vista/tp4/1/verAutos.php\' target="_blank">ver</a>');
                } elseif ($answer->getValue() == 'syc') {
                    $this->say('Trabajo práctico Nro5 (Sessions and Cookies) <a href=\'http://localhost/PWD2021/TP1/vista/tp5/1/listarUsuarios.php\' target="_blank">ver</a>');
                }
            } else {
                //el usuario no respondio a traves de los botones dados, si queremos leer ambas, solo sacamos la condicion
                $this->say('Seleccione una opción');
                $this->repeat(); //se repite esta funcion
            }
        });
    }
}
