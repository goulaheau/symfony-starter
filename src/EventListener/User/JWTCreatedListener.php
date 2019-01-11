<?php

namespace App\EventListener\User;

use App\Entity\User\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated($event)
    {
        $payload = $event->getData();

        /** @var User $user */
        $user = $event->getUser();

        $payload['user'] = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'roles' => $user->getRoles(),
        ];

        $event->setData($payload);
    }
}
