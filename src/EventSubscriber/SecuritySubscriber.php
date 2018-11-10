<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Console\Event\ConsoleCommandEvent;

class SecuritySubscriber implements EventSubscriberInterface
{
    public function onConsoleCommand(ConsoleCommandEvent $event)
    {
        // ...
    }

    public static function getSubscribedEvents()
    {
        return [
           'console.command' => 'onConsoleCommand',
        ];
    }
}
