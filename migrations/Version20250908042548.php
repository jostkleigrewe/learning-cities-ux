<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250908042548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, slug VARCHAR(180) NOT NULL, population INT DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, INDEX IDX_2D5B02345E237E06 (name), UNIQUE INDEX uniq_city_slug (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE district (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, name VARCHAR(180) NOT NULL, slug VARCHAR(180) NOT NULL, INDEX IDX_31C154878BAC62AF (city_id), INDEX IDX_31C154875E237E06 (name), UNIQUE INDEX uniq_city_slug (city_id, slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, district_id INT NOT NULL, name VARCHAR(180) NOT NULL, slug VARCHAR(180) NOT NULL, category VARCHAR(50) NOT NULL, address VARCHAR(255) DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, INDEX IDX_741D53CDB08FA272 (district_id), INDEX IDX_741D53CD5E237E06 (name), INDEX IDX_741D53CD64C19C1 (category), UNIQUE INDEX uniq_district_slug (district_id, slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE district ADD CONSTRAINT FK_31C154878BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CDB08FA272 FOREIGN KEY (district_id) REFERENCES district (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE district DROP FOREIGN KEY FK_31C154878BAC62AF');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CDB08FA272');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE district');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
