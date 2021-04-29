<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210429110205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE licitatie (licitatie_id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, user_id INT NOT NULL, pret_licitat INT NOT NULL, data_pret_licitat DATETIME NOT NULL, PRIMARY KEY(licitatie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (product_id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_title VARCHAR(255) NOT NULL, product_description VARCHAR(255) DEFAULT NULL, photo_a VARCHAR(255) NOT NULL, photo_b VARCHAR(255) DEFAULT NULL, photo_c VARCHAR(255) DEFAULT NULL, photo_d VARCHAR(255) DEFAULT NULL, photo_e VARCHAR(255) DEFAULT NULL, photo_f VARCHAR(255) DEFAULT NULL, category VARCHAR(255) NOT NULL, pret_pornire INT NOT NULL, ultimul_pret_licitat INT NOT NULL, data_stop DATETIME NOT NULL, PRIMARY KEY(product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produsefavorite (favorite_id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_id INT NOT NULL, PRIMARY KEY(favorite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (user_id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE licitatie');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE produsefavorite');
        $this->addSql('DROP TABLE user');
    }
}
