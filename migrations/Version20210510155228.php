<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210510155228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dataset (id INT AUTO_INCREMENT NOT NULL, country_code VARCHAR(255) NOT NULL, description_en VARCHAR(255) DEFAULT NULL, description_de VARCHAR(255) DEFAULT NULL, description_fr VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE distribution (id INT AUTO_INCREMENT NOT NULL, dataset_id INT NOT NULL, format VARCHAR(255) NOT NULL, download_url VARCHAR(255) NOT NULL, INDEX IDX_A4483781D47C2D1B (dataset_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE distribution ADD CONSTRAINT FK_A4483781D47C2D1B FOREIGN KEY (dataset_id) REFERENCES dataset (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE distribution DROP FOREIGN KEY FK_A4483781D47C2D1B');
        $this->addSql('DROP TABLE dataset');
        $this->addSql('DROP TABLE distribution');
    }
}
