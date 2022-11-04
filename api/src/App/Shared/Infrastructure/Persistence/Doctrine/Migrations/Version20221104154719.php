<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221104154719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id UUID NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3AF346685E237E06 ON categories (name)');
        $this->addSql('COMMENT ON COLUMN categories.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE details (id UUID NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_72260B8A5E237E06 ON details (name)');
        $this->addSql('COMMENT ON COLUMN details.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE products (id UUID NOT NULL, detail_id UUID NOT NULL, category_id UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AD8D003BB ON products (detail_id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A12469DE2 ON products (category_id)');
        $this->addSql('CREATE UNIQUE INDEX products_categories_detail_id_category_id_key ON products (detail_id, category_id)');
        $this->addSql('COMMENT ON COLUMN products.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE recipe_items (id UUID NOT NULL, recipe_id UUID DEFAULT NULL, product_id UUID DEFAULT NULL, quantity INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN recipe_items.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE recipes (id UUID NOT NULL, product_id UUID DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A369E2B54584665A ON recipes (product_id)');
        $this->addSql('COMMENT ON COLUMN recipes.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE users (id UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN users.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN users.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AD8D003BB FOREIGN KEY (detail_id) REFERENCES details (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_items ADD CONSTRAINT FK_F70D3D5259D8A214 FOREIGN KEY (recipe_id) REFERENCES recipes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_items ADD CONSTRAINT FK_F70D3D524584665A FOREIGN KEY (product_id) REFERENCES products (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipes ADD CONSTRAINT FK_A369E2B54584665A FOREIGN KEY (product_id) REFERENCES products (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE products DROP CONSTRAINT FK_B3BA5A5AD8D003BB');
        $this->addSql('ALTER TABLE products DROP CONSTRAINT FK_B3BA5A5A12469DE2');
        $this->addSql('ALTER TABLE recipe_items DROP CONSTRAINT FK_F70D3D5259D8A214');
        $this->addSql('ALTER TABLE recipe_items DROP CONSTRAINT FK_F70D3D524584665A');
        $this->addSql('ALTER TABLE recipes DROP CONSTRAINT FK_A369E2B54584665A');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE details');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE recipe_items');
        $this->addSql('DROP TABLE recipes');
        $this->addSql('DROP TABLE users');
    }
}
