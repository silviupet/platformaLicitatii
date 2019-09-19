<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190919185712 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE licitatie (licitatie_id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, user_id INT NOT NULL, pret_licitat INT NOT NULL, data_pret_licitat DATETIME NOT NULL, PRIMARY KEY(licitatie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produsefavorite (favorite_id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_id INT NOT NULL, PRIMARY KEY(favorite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD pret_pornire INT NOT NULL, ADD ultimul_pret_licitat INT NOT NULL, ADD data_stop DATETIME NOT NULL, CHANGE product_description product_description VARCHAR(255) DEFAULT NULL, CHANGE photo_b photo_b VARCHAR(255) DEFAULT NULL, CHANGE photo_c photo_c VARCHAR(255) DEFAULT NULL, CHANGE photo_d photo_d VARCHAR(255) DEFAULT NULL, CHANGE photo_e photo_e VARCHAR(255) DEFAULT NULL, CHANGE photo_f photo_f VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE licitatie');
        $this->addSql('DROP TABLE produsefavorite');
        $this->addSql('ALTER TABLE product DROP pret_pornire, DROP ultimul_pret_licitat, DROP data_stop, CHANGE product_description product_description VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE photo_b photo_b VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE photo_c photo_c VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE photo_d photo_d VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE photo_e photo_e VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE photo_f photo_f VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
