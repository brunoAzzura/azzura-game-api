<?php

// src/EventSubscriber/ExceptionSubscriber.php
namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ImageEntitySubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        // event can be dispatch with dispatcher in a controller ...
        return [
            'user.update' => 'updateUser'
        ];
    }

    // use Symfony\Component\EventDispatcher\EventDispatcher;
    // use Symfony\Component\EventDispatcher\Event;
    // creates the OrderPlacedEvent and dispatches it
    // $event = new OrderPlacedEvent($order);
    // $dispatcher->dispatch(OrderPlacedEvent::NAME, $event);

    public function updateUser(GenericEvent $event): void
    {
        /** @var User $user */
        $user = $event->getSubject();
        // ...
    }
}
