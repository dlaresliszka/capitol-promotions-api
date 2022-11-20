<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221120104311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Product table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE `products` (
                id INTEGER NOT NULL AUTO_INCREMENT,
                sku VARCHAR(30) NOT NULL,
                name VARCHAR(100) NOT NULL,
                category VARCHAR(100) NOT NULL,
                price INTEGER DEFAULT NULL,
                PRIMARY KEY (id)
            )'
        );

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
