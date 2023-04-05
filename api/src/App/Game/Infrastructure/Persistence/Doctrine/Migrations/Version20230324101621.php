<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * @codeCoverageIgnore
 */
final class Version20230324101621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create main tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE categories (id VARCHAR(15) NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3AF346685E237E06 ON categories (name)');
        $this->addSql('COMMENT ON COLUMN categories.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE characteristics (id VARCHAR(15) NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7037B1565E237E06 ON characteristics (name)');
        $this->addSql('COMMENT ON COLUMN characteristics.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE recipe_items (id UUID NOT NULL, recipe_id VARCHAR(15) NOT NULL, unit_id UUID NOT NULL, quantity INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F70D3D5259D8A214 ON recipe_items (recipe_id)');
        $this->addSql('CREATE INDEX IDX_F70D3D52F8BD700D ON recipe_items (unit_id)');
        $this->addSql('COMMENT ON COLUMN recipe_items.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE recipes (id VARCHAR(15) NOT NULL, unit_id UUID NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A369E2B55E237E06 ON recipes (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A369E2B5F8BD700D ON recipes (unit_id)');
        $this->addSql('COMMENT ON COLUMN recipes.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE unit_characteristics (id UUID NOT NULL, unit_id UUID NOT NULL, characteristic_id VARCHAR(15) NOT NULL, value INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FD4FB8EEF8BD700D ON unit_characteristics (unit_id)');
        $this->addSql('CREATE INDEX IDX_FD4FB8EEDEE9D12B ON unit_characteristics (characteristic_id)');
        $this->addSql('CREATE TABLE unit_cost (id UUID NOT NULL, unit_id UUID NOT NULL, value INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_94E075A6F8BD700D ON unit_cost (unit_id)');
        $this->addSql('CREATE TABLE units (id UUID NOT NULL, category_id VARCHAR(15) NOT NULL, slug VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E9B07449989D9B62 ON units (slug)');
        $this->addSql('CREATE INDEX IDX_E9B0744912469DE2 ON units (category_id)');
        $this->addSql('COMMENT ON COLUMN units.slug IS \'(DC2Type:slug)\'');
        $this->addSql('COMMENT ON COLUMN units.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE recipe_items ADD CONSTRAINT FK_F70D3D5259D8A214 FOREIGN KEY (recipe_id) REFERENCES recipes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_items ADD CONSTRAINT FK_F70D3D52F8BD700D FOREIGN KEY (unit_id) REFERENCES units (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipes ADD CONSTRAINT FK_A369E2B5F8BD700D FOREIGN KEY (unit_id) REFERENCES units (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unit_characteristics ADD CONSTRAINT FK_FD4FB8EEF8BD700D FOREIGN KEY (unit_id) REFERENCES units (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unit_characteristics ADD CONSTRAINT FK_FD4FB8EEDEE9D12B FOREIGN KEY (characteristic_id) REFERENCES characteristics (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unit_cost ADD CONSTRAINT FK_94E075A6F8BD700D FOREIGN KEY (unit_id) REFERENCES units (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE units ADD CONSTRAINT FK_E9B0744912469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE recipe_items DROP CONSTRAINT FK_F70D3D5259D8A214');
        $this->addSql('ALTER TABLE recipe_items DROP CONSTRAINT FK_F70D3D52F8BD700D');
        $this->addSql('ALTER TABLE recipes DROP CONSTRAINT FK_A369E2B5F8BD700D');
        $this->addSql('ALTER TABLE unit_characteristics DROP CONSTRAINT FK_FD4FB8EEF8BD700D');
        $this->addSql('ALTER TABLE unit_characteristics DROP CONSTRAINT FK_FD4FB8EEDEE9D12B');
        $this->addSql('ALTER TABLE unit_cost DROP CONSTRAINT FK_94E075A6F8BD700D');
        $this->addSql('ALTER TABLE units DROP CONSTRAINT FK_E9B0744912469DE2');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE characteristics');
        $this->addSql('DROP TABLE recipe_items');
        $this->addSql('DROP TABLE recipes');
        $this->addSql('DROP TABLE unit_characteristics');
        $this->addSql('DROP TABLE unit_cost');
        $this->addSql('DROP TABLE units');
    }
}
