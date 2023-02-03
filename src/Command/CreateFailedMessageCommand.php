<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Message\AppMessage;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(name: 'app:create-failed-message')]
class CreateFailedMessageCommand extends Command
{
 //...
    private $bus;

    public function __construct(MessageBusInterface $bus)
    {
		parent::__construct();
        $this->bus = $bus;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->bus->dispatch(new AppMessage());
        return Command::SUCCESS;
    }
}

