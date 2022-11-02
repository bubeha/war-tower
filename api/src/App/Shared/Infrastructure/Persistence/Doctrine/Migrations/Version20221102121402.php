<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221102121402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add product_categories table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE products_categories (id UUID NOT NULL, product_id UUID NOT NULL, category_id UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E8ACBE764584665A ON products_categories (product_id)');
        $this->addSql('CREATE INDEX IDX_E8ACBE7612469DE2 ON products_categories (category_id)');
        $this->addSql('CREATE UNIQUE INDEX products_categories_product_id_category_id_key ON products_categories (product_id, category_id)');
        $this->addSql('COMMENT ON COLUMN products_categories.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE products_categories ADD CONSTRAINT FK_E8ACBE764584665A FOREIGN KEY (product_id) REFERENCES products (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE products_categories ADD CONSTRAINT FK_E8ACBE7612469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE categories ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE products ALTER id TYPE UUID');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE products_categories DROP CONSTRAINT FK_E8ACBE764584665A');
        $this->addSql('ALTER TABLE products_categories DROP CONSTRAINT FK_E8ACBE7612469DE2');
        $this->addSql('DROP TABLE products_categories');
        $this->addSql('ALTER TABLE products ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE categories ALTER id TYPE UUID');
    }
}
