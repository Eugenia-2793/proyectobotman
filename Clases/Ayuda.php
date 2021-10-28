<?php

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class Ayuda extends Conversation
{

    public function run()
    {
        //creamos una pregunta que contendra botones
        $preguntas = Question::create('Opciones de ayuda')
            ->addButtons([ //arreglo de los botones de opciones
                Button::create('Funcionalidad')->value('f'),
                Button::create('Info')->value('i'),
            ]);
        $this->ask($preguntas, function ($answer) {
            //pregunta a traves de los botones y el usuario responde
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() == 'f') {
                    $this->say('Este bot funciona a traves de la deteccion de palabras claves, para mas info escribir "ayuda"');
                } elseif ($answer->getValue() == 'i') {
                    $this->say('Este bot brinda informacion sobre trabajos de la materia PWD y comandos de Git');
                }
            } else {
                $this->say('Seleccione una opcion');
                $this->repeat(); //se repite esta funcion
            }
        });
    }
}
