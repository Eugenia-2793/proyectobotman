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
                    $this->say(' 

                    Configurar Nombre que salen en los commits <br>
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
                    "Texto que identifique por que se hizo el commit"  subimos al repositorio<br>
                             <b>git push origin master</b><br>
                ');
                }elseif ($answer->getValue() == '3') {
                    $this->say('

                    Clonamos el repositorio de github o bitbucket <br>
                             <b>git clone url  </b> <br>
                    Clonamos el repositorio de github o bitbucket ????? <br>
                             <b>git clone url git-demo  </b><br>');
                }elseif ($answer->getValue() == '4') {
                    $this->say('
                    
                    Añadimos todos los archivos para el commit<br>
                           <b> git add . </b><br>
                    Añadimos el archivo para el commit<br>
                           <b> git add archivo</b><br>
                    Añadimos todos los archivos para el commit omitiendo los nuevos<br>
                           <b> git add --all </b><br>
                    Añadimos todos los archivos con la extensión especificada<br>
                           <b> git add *.txt</b><br>
                    Añadimos todos los archivos dentro de un directorio y de una extensión especifica<br>
                           <b> git add docs/*.txt</b><br>
                    Añadimos todos los archivos dentro de un directorios<br>
                             <b> git add docs/</b>
                    ');
                }elseif ($answer->getValue() == '5') {
                    $this->say('
                    
                    Cargar en el HEAD los cambios realizados <br/>
                       <b> git commit -m "Texto que identifique por que se hizo el commit"</b> <br/>
                    Agregar y Cargar en el HEAD los cambios realizados<br/>
                       <b> git commit -a -m "Texto que identifique por que se hizo el commit"</b><br/>
                    De haber conflictos los muestra<br/>
                       <b> git commit -a</b> <br/>
                    Agregar al ultimo commit, este no se muestra como un nuevo commit en los logs. Se puede especificar un nuevo mensaje<br/>
                       <b> git commit --amend -m "Texto que identifique por que se hizo el commit"</b><br/>
                    
                    ');
                }elseif ($answer->getValue() == '6') {
                    $this->say('
                    Subimos al repositorio                     <br>
                       <b> git push origien branch </b>        <br>
                    Subimos un tag                             <br>
                       <b> git push --tags       </b>          <br>
                    
                    ');
                }elseif ($answer->getValue() == '7') {
                    $this->say('
                    
                    Muestra los logs de los commits <br>
                       <b> git log  </b> <br>
                    Muestras los cambios en los commits <br>
                       <b> git log --oneline --stat   </b>     <br>
                    Muestra graficos de los commits     <br>
                       <b> git log --oneline --graph    </b>   <br>
                    ');
                }elseif ($answer->getValue() == '8') {
                    $this->say('
                    
                    Muestra los cambios realizados a un archivo <br>
                        <b> git diff </b> <br>
                        <b> git diff --staged </b> <br>
                    ');
                }elseif ($answer->getValue() == '9') {
                    $this->say('
                    Saca un archivo del commit       <br>
                       <b> git reset HEAD <archivo> </b>       <br>
                    Devuelve el ultimo commit que se hizo y pone los cambios en staging     <br>

                       <b> git reset --soft HEAD^ </b><br>
                    Devuelve el ultimo commit y todos los cambios   <br>

                       <b> git reset --hard HEAD^ </b> <br>
                    Devuelve los 2 ultimo commit y todos los cambios    <br>

                       <b> git reset --hard HEAD^^ </b><br>
                    Rollback merge/commit<br>

                       <b> git log</b>
                       <b> git reset --hard commit_sha </b>  <br>
                    
                    ');
                }elseif ($answer->getValue() == '10') {
                    $this->say('
                    
                Agregar repositorio remoto<br>

                   <b>  git remote add origin url </b>  <br>
                Cambiar de remote<br>
                
                   <b>  git remote set-url origin url </b>  <br>
                Remover repositorio<br>
                
                   <b>  git remote rm name/origin </b>  <br>
                Muestra lista repositorios<br>
                
                   <b>  git remote -v </b>  <br>
                Muestra los branches remotos<br>
                
                   <b>  git remote show origin </b>  <br>
                Limpiar todos los branches eliminados <br/>
                
                   <b>  git remote prune origin ');

                }elseif ($answer->getValue() == '11') {
                    //$this->say('1');
                }elseif ($answer->getValue() == '12') {
                    //$this->say('1');
                }
                elseif ($answer->getValue() ==  '13') {
                    //$this->say('1');
                }elseif ($answer->getValue() == '14') {
                    //$this->say('1');
                }elseif ($answer->getValue() == '15') {
                    //$this->say('1');
                }


            } else {
                $this->say('Seleccione una opcion');
                $this->repeat();//se repite esta funcion
            }
        });
    }
}