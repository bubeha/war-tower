<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221104130532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE recipe_products (id UUID NOT NULL, recipe_id UUID DEFAULT NULL, product_id UUID DEFAULT NULL, quantity INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN recipe_products.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE recipes (id UUID NOT NULL, product_id UUID DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A369E2B54584665A ON recipes (product_id)');
        $this->addSql('COMMENT ON COLUMN recipes.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE recipe_products ADD CONSTRAINT FK_C52AFFC459D8A214 FOREIGN KEY (recipe_id) REFERENCES recipes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_products ADD CONSTRAINT FK_C52AFFC44584665A FOREIGN KEY (product_id) REFERENCES products_categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipes ADD CONSTRAINT FK_A369E2B54584665A FOREIGN KEY (product_id) REFERENCES products_categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE recipe_products DROP CONSTRAINT FK_C52AFFC459D8A214');
        $this->addSql('ALTER TABLE recipe_products DROP CONSTRAINT FK_C52AFFC44584665A');
        $this->addSql('ALTER TABLE recipes DROP CONSTRAINT FK_A369E2B54584665A');
        $this->addSql('DROP TABLE recipe_products');
        $this->addSql('DROP TABLE recipes');
    }
}
