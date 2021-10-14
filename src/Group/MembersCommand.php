<?php

declare(strict_types=1);

namespace OktaClient\Group;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function array_keys;
use function count;
use function sprintf;

class MembersCommand extends Command
{
    private GetMembers $getMembers;

    public function __construct(GetMembers $getMembers)
    {
        $this->getMembers = $getMembers;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('group:members');
        $this->setDescription('Lists the members of a group');
        $this->addArgument('group-id', InputArgument::REQUIRED, 'Id of the group');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $groupId = (string) $input->getArgument('group-id');

        $collection = $this->getMembers->invoke($groupId)->allAsArray();

        if (0 === count($collection)) {
            $output->writeln(sprintf('No members found for Group "%s".', $groupId));
            return 0;
        }

        $table = new Table($output);
        $table->setHeaders(array_keys($collection[0]));
        $table->setRows($collection);
        $table->render();

        return 0;
    }
}
