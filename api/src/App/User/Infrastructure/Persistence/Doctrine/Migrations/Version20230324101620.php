<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230324101620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create users tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE users (id UUID NOT NULL, name VARCHAR(255) NOT NULL, nickname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9A188FE64 ON users (nickname)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('COMMENT ON COLUMN users.created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE users');
    }
}
