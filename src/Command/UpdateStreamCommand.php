<?php

declare(strict_types=1);

namespace ProjetNormandie\TwitchBundle\Command;

use Exception;
use ProjetNormandie\TwitchBundle\Scheduler\Message\UpdateStream;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'pn-twitch:update-stream',
    description: 'Check steams'
)]
class UpdateStreamCommand extends Command
{

    public function __construct(
        private readonly MessageBusInterface $bus
    ) {
        parent::__construct();
    }


    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->bus->dispatch(new UpdateStream());
        return Command::SUCCESS;
    }
}
