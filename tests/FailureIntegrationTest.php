<?php

namespace App\Tests;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

class FailureIntegrationTest extends KernelTestCase
{
    private const MESSENGER_MESSAGES_TABLE = 'MESSENGER_MESSAGES';

    public function testFailedTransportShowCommand()
    {        
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $this->cleanDatabase();

        $this->executeCommand($application->find('app:create-failed-message'));
        $this->executeCommand($application->find('messenger:consume'), ['receivers' => ['async'], '--limit' => 1]);
        $this->executeCommand($application->find('messenger:failed:show'));

    }

    private function cleanDatabase() : void
    {
        $connection = self::$kernel->getContainer()->get('database_connection');

        if ($connection->createSchemaManager()->tablesExist(self::MESSENGER_MESSAGES_TABLE)) {
            $connection->executeStatement(
                $connection->getDatabasePlatform()->getTruncateTableSQL(self::MESSENGER_MESSAGES_TABLE));
        }
    }

    private function executeCommand(Command $command, array $params= [])
    {
        $createMessageCommandTester = new CommandTester($command);
        $createMessageCommandTester->execute($params);
        $createMessageCommandTester->assertCommandIsSuccessful();
    
    }

}