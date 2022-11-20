<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221120134121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO products (sku, name, category, price) VALUES 
            ("000001","BV Lean leather ankle boots","boots",89000),
            ("000002","BV Lean leather ankle boots","boots",99000),
            ("000003","Ashlington leather ankle boots","boots",71000),
            ("000004","Naima embellished suede sandals","sandals",79500),
            ("000005","Nathane leather sneakers","sneakers",59000)
        ');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        
    }
}

// GIVEN PRODUCTS FROM THE TEST
// {
//     "sku": "000001",
//     "name": "BV Lean leather ankle boots",
//     "category": "boots",
//     "price": 89000
// },
// {
//     "sku": "000002",
//     "name": "BV Lean leather ankle boots",
//     "category": "boots",
//     "price": 99000
// },
// {
//     "sku": "000003",
//     "name": "Ashlington leather ankle boots",
//     "category": "boots",
//     "price": 71000
// },
// {
//     "sku": "000004",
//     "name": "Naima embellished suede sandals",
//     "category": "sandals",
//     "price": 79500
// },
// {
//     "sku": "000005",
//     "name": "Nathane leather sneakers",
//     "category": "sneakers",
//     "price": 59000
// }