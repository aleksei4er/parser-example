<?php

declare(strict_types=1);

namespace App\Shared\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210210194036 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE parser_item (id BIGINT AUTO_INCREMENT NOT NULL, site_id BIGINT DEFAULT NULL, href VARCHAR(500) NOT NULL, data LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_4C729CE1F6BD1646 (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parser_site (id BIGINT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE parser_item ADD CONSTRAINT FK_4C729CE1F6BD1646 FOREIGN KEY (site_id) REFERENCES parser_site (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parser_item DROP FOREIGN KEY FK_4C729CE1F6BD1646');
        $this->addSql('DROP TABLE parser_item');
        $this->addSql('DROP TABLE parser_site');
    }
}
