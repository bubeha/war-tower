<?php

declare(strict_types=1);

namespace App\User\Application\SignUp;

use App\Shared\Application\Bus\Command\Command;
use App\Shared\Domain\ValueObject\Id\Uuid;
use App\User\Domain\ValueObject\Email;

final readonly class SignUpCommand implements Command
{
    private Uuid $id;
    private Email $email;

    public function __construct(string $id, private string $name, string $email)
    {
        $this->id = Uuid::fromString($id);
        $this->email = Email::fromString($email);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }
}
