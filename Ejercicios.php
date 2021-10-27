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
                    $this->say('Trabajo practico Nro1 (Modelo/Vista/Control) <a href=\'#\'>ver</a>');
                } elseif ($answer->getValue() == 'bt') {
                    $this->say('Trabajo practico Nro2 (Bootstrap) <a href=\'#\'>ver</a>');
                } elseif ($answer->getValue() == 'files') {
                    $this->say('Trabajo practico Nro3 (Subir Aarchivos) <a href=\'#\'>ver</a>');
                } elseif ($answer->getValue() == 'ormabm') {
                    $this->say('Trabajo practico Nro4 (ORM - ABM) <a href=\'#\'>ver</a>');
                } elseif ($answer->getValue() == 'syc') {
                    $this->say('Trabajo practico Nro5 (Sessions and Cookies) <a href=\'#\'>ver</a>');
                }
            } else {
                //el usuario no respondio a traves de los botones dados, si queremos leer ambas, solo sacamos la condicion
                $this->say('Seleccione una opcion');
                $this->repeat();//se repite esta funcion
            }
        });
    }
}