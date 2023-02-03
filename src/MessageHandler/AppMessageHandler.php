<?php

namespace App\MessageHandler;
use App\Message\AppMessage;
use Symfony\Component\Messenger\Exception\TransportException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AppMessageHandler implements MessageHandlerInterface
{

    public function __construct(
    ) {
    }

    public function __invoke(AppMessage $appMessage)
    {
        throw new TransportException("Fake exception");
    }
}
