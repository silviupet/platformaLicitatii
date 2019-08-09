<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190809112711 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product (product_id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_title VARCHAR(255) NOT NULL, product_description VARCHAR(255) NOT NULL, photo_a VARCHAR(255) NOT NULL, photo_b VARCHAR(255) DEFAULT NULL, photo_c VARCHAR(255) DEFAULT NULL, photo_d VARCHAR(255) DEFAULT NULL, photo_e VARCHAR(255) DEFAULT NULL, photo_f VARCHAR(255) DEFAULT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (user_id INT AUTO_INCREMENT NOT NULL, email VARCHAR(64) NOT NULL, hashed_password VARCHAR(64) NOT NULL, sign_up_date DATETIME NOT NULL, PRIMARY KEY(user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE user');
    }
}
