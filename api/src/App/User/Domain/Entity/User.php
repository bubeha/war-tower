<?php

declare(strict_types=1);

namespace App\User\Domain\Entity;

use App\Shared\Domain\ValueObject\DateTime;
use App\Shared\Domain\ValueObject\Id\Uuid;
use App\User\Domain\ValueObject\Email;

/**
 * @final
 */
class User
{
    public function __construct(private readonly Uuid $id, private string $name, private string $nickname, private Email $email, private readonly ?DateTime $createdAt)
    {
    }

    /**
     * @throws \App\Shared\Domain\Exception\DateTimeException
     */
    public static function create(Uuid $id, string $name, string $nickname, Email $email, ?DateTime $createdAt = null): self
    {
        return new self($id, $name, $nickname, $email, $createdAt ?? DateTime::now());
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function setEmail(Email $email): void
    {
        $this->email = $email;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }
}
