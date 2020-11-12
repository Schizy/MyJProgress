<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201111170111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE example (id INT AUTO_INCREMENT NOT NULL, grammar_id INT DEFAULT NULL, phrase VARCHAR(255) NOT NULL, translation VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_6EEC9B9FB0CA2760 (grammar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grammar (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE example ADD CONSTRAINT FK_6EEC9B9FB0CA2760 FOREIGN KEY (grammar_id) REFERENCES grammar (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE example DROP FOREIGN KEY FK_6EEC9B9FB0CA2760');
        $this->addSql('DROP TABLE example');
        $this->addSql('DROP TABLE grammar');
    }
}
