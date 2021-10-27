<?php

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class Comandos extends Conversation
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
        $preguntas = Question::create('Opciones de comandos')
            ->addButtons([ //arreglo de los botones de opciones
                Button::create('Configuración Básica')->value('1'),
                Button::create('Iniciando repositorio')->value('2'),
                Button::create('Git clone')->value('3'),
                Button::create('Git add')->value('4'),
                Button::create('Git commit')->value('5'),
                Button::create('Git push')->value('6'),
                Button::create('Git log')->value('7'),
                Button::create('Git diff')->value('8'),
                Button::create('Git head')->value('9'),
                Button::create('Git remote')->value('10'),
                Button::create('Git branch')->value('11'),
                Button::create('Git tag')->value('12'),
                Button::create('Git rebase')->value('13'),
                Button::create('Otros')->value('14'),
                Button::create('Fork')->value('15'),
            ]);
        $this->ask($preguntas, function ($answer) {
            //pregunta a traves de los botones y el usuario responde
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() == '1') {     
                    $this->say(' Configurar Nombre que salen en los commits <br>
                                <b> git config --global user.name "dasdo" </b><br>
                                Configurar Email <br>
                                <b> git config --global user.email dasdo1@gmail.com</b><br>
                                Marco de colores para los comando <br>
                                <b> git config --global color.ui true </b> ');
                } elseif ($answer->getValue() == '2') {
                    $this->say('
                    
                    Iniciamos GIT en la carpeta donde esta el proyecto <br>

                    <b>git init</b><br>
                    Clonamos el repositorio de github o bitbucket<br>
                    
                        <b>git clone url </b><br>
                    Añadimos todos los archivos para el commit<br>
                    
                        <b>git add .</b><br>
                    Hacemos el primer commit<br>
                    
                        <b>git commit -m </b><br>
                    "Texto que identifique por que se hizo el commit"<br>
                    
                    subimos al repositorio<br>
                    
                        <b>git push origin master</b><br>
                ');
                }elseif ($answer->getValue() == '3') {
                    $this->say('1');
                }elseif ($answer->getValue() == '4') {
                    $this->say('1');
                }elseif ($answer->getValue() == '5') {
                    $this->say('1');
                }elseif ($answer->getValue() == '6') {
                    $this->say('1');
                }elseif ($answer->getValue() == '7') {
                    $this->say('1');
                }elseif ($answer->getValue() == '8') {
                    $this->say('1');
                }elseif ($answer->getValue() == '9') {
                    $this->say('1');
                }elseif ($answer->getValue() == '10') {
                    $this->say('1');
                }elseif ($answer->getValue() == '11') {
                    $this->say('1');
                }elseif ($answer->getValue() == '12') {
                    $this->say('1');
                }


            } else {
                $this->say('Seleccione una opcion');
                $this->repeat();//se repite esta funcion
            }
        });
    }
}