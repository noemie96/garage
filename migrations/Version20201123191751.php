<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123191751 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ad (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, km DOUBLE PRECISION NOT NULL, price DOUBLE PRECISION NOT NULL, number_of_owners DOUBLE PRECISION NOT NULL, displacement NUMERIC(10, 2) NOT NULL, power NUMERIC(10, 2) NOT NULL, fuel VARCHAR(255) NOT NULL, circulation_year DATE NOT NULL, transmission VARCHAR(255) NOT NULL, description TINYTEXT NOT NULL, others_option LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ad');
    }
}
