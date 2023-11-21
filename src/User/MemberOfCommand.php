<?php

declare(strict_types=1);

namespace OktaClient\User;

use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function sprintf;

class MemberOfCommand extends Command
{
    public function __construct(private readonly MemberOf $memberOf)
    {
        parent::__construct('user:member-of');
    }

    protected function configure(): void
    {
        $this->setDescription('Checks if a user is a member of a user group');

        $this->addArgument(
            'user-id',
            InputArgument::REQUIRED,
            'Okta User Id'
        );

        $this->addArgument(
            'user-group-name',
            InputArgument::REQUIRED,
            'Okta User Group Name'
        );
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<info>Check if user is group member</info>');
        $output->writeln('');

        $userId        = (string) $input->getArgument('user-id');
        $userGroupName = (string) $input->getArgument('user-group-name');

        if ($this->memberOf->invoke($userId, $userGroupName)) {
            $output->writeln(sprintf(
                'User "%s" is a member of group "%s".',
                $userId,
                $userGroupName
            ));

            return 0;
        }

        $output->writeln(sprintf(
            '<error>User "%s" is not a member of group "%s".</error>',
            $userId,
            $userGroupName
        ));

        return 0;
    }
}
