<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230323143107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create recipe and recipe_items table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE recipe_items (id UUID NOT NULL, recipe_id UUID NOT NULL, unit_id UUID NOT NULL, quantity INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F70D3D5259D8A214 ON recipe_items (recipe_id)');
        $this->addSql('CREATE INDEX IDX_F70D3D52F8BD700D ON recipe_items (unit_id)');
        $this->addSql('COMMENT ON COLUMN recipe_items.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE recipes (id UUID NOT NULL, unit_id UUID NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A369E2B55E237E06 ON recipes (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A369E2B5F8BD700D ON recipes (unit_id)');
        $this->addSql('COMMENT ON COLUMN recipes.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE recipe_items ADD CONSTRAINT FK_F70D3D5259D8A214 FOREIGN KEY (recipe_id) REFERENCES recipes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_items ADD CONSTRAINT FK_F70D3D52F8BD700D FOREIGN KEY (unit_id) REFERENCES units (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipes ADD CONSTRAINT FK_A369E2B5F8BD700D FOREIGN KEY (unit_id) REFERENCES units (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE recipe_items DROP CONSTRAINT FK_F70D3D5259D8A214');
        $this->addSql('ALTER TABLE recipe_items DROP CONSTRAINT FK_F70D3D52F8BD700D');
        $this->addSql('ALTER TABLE recipes DROP CONSTRAINT FK_A369E2B5F8BD700D');
        $this->addSql('DROP TABLE recipe_items');
        $this->addSql('DROP TABLE recipes');
    }
}
