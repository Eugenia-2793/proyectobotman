<?php

use BotMan\BotMan\Messages\Conversations\Conversation;

class OnboardingConversation extends Conversation
{

    protected $firstname;

    public function askFirstname()
    {
        $this->ask('Hola, ¿cuál es tu nombre?', function ($answer) {
            $firstName = $answer->getText();
            $this->say('Encantado de conocerte ' . $firstName);
        });
    }


    public function run()
    {
        $this->askFirstname();
    }
}
