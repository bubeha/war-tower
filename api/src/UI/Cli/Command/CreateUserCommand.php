<?php

declare(strict_types=1);

namespace UI\Cli\Command;

use App\Shared\Application\Bus\Command\CommandBus;
use App\Shared\Domain\ValueObject\Id\Uuid;
use App\User\Application\SignUp\SignUpCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:create-user', description: 'Given a uuid and email, generates a new user.')]
final class CreateUserCommand extends Command
{
    public function __construct(private readonly CommandBus $commandBus)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Given a uuid and email, generates a new user.')
            ->addArgument('name', InputArgument::REQUIRED, 'User Full Name')
            ->addArgument('email', InputArgument::REQUIRED, 'User Unique Email')
            ->addArgument('uuid', InputArgument::OPTIONAL, 'User UUID')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var string $uuid */
        $uuid = $input->getArgument('uuid') ?: Uuid::generate()->toString();
        /** @var string $name */
        $name = $input->getArgument('name');
        /** @var string $email */
        $email = $input->getArgument('email');

        $this->commandBus->handle(
            new SignUpCommand($uuid, $name, $email),
        );

        $output->writeln('<info>User Created: </info>');
        $output->writeln('');
        $output->writeln("Uuid: {$uuid}");
        $output->writeln("Full Name: {$name}");
        $output->writeln("Email: {$email}");

        return Command::SUCCESS;
    }
}
