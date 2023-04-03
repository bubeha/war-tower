<?php

declare(strict_types=1);

namespace App\User\Domain\ValueObject;

use Webmozart\Assert\Assert;

final class Email
{
    private function __construct(private readonly string $email)
    {
    }

    public static function fromString(string $email): static
    {
        Assert::email($email, 'The value is not a valid e-mail address');

        return new self($email);
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return $this->email;
    }
}
