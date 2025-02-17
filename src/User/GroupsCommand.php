<?php

declare(strict_types=1);

namespace OktaClient\User;

use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function array_keys;
use function count;
use function sprintf;

final class GroupsCommand extends Command
{
    public function __construct(
        private readonly Repository $repository,
    ) {
        parent::__construct('user:groups');
    }

    protected function configure(): void
    {
        $this->setDescription('Get Groups of given Okta User');

        $this->addArgument(
            'user-id',
            InputArgument::REQUIRED,
            'Okta User Id'
        );
    }

    /**
     * @throws JsonException
     * @throws ClientExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<info>Get Groups of a User</info>');
        $output->writeln('');

        $userId = (string) $input->getArgument('user-id');

        $userGroupCollection = $this->repository->getGroups($userId);

        $userGroups = $userGroupCollection->toArray();

        if (0 === count($userGroups)) {
            $output->writeln(sprintf('No groups found for User "%s".', $userId));
            return 0;
        }

        $table = new Table($output);
        $table->setHeaders(array_keys($userGroups[0]));
        $table->setRows($userGroups);
        $table->render();

        return 0;
    }
}
