<?php

use BotMan\BotMan\Messages\Conversations\Conversation;

class Hablar extends Conversation
{
    protected $respuesta;

    /*Es un objeto de la clase
     Say, ask, repeat, son propios  de la clase conversation
     ask, es para realizar una pregunta al usuario
     say, es para decirle alguna respuesta al usuario
    */
    public function charla()
    {
        $this->ask('Como estas?', function ($answer) {
            //la respuesta del usuario es un objeto y del objeto obtener el mensaje
            $respuesta = $answer->getText();
            if (preg_match("/vos?/", $respuesta)) {
                //preg_match compara expresion regular, si $respuesta trae una subcadena igual a 'vos?' entonces ingresa
                $this->say('Bien, gracias por preguntarme');
            } elseif (preg_match("/\W/", $respuesta)) {   //\W:caracteres especiales
                $this->say('No me agradan los caracteres especiales <br>');
                return $this->repeat();
            }
            // volvemos a escuchar al usuario desde botman.php
            $this->say('que desea realizar?');
        });
    }

    //ejecuta la clase y llama a la funcion charla

    public function run()
    {
        $this->charla();
    }
}
