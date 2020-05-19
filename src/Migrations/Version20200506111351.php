<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200506111351 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE proprietes_categori (proprietes_id INT NOT NULL, categori_id INT NOT NULL, INDEX IDX_5375D448A1005530 (proprietes_id), INDEX IDX_5375D448425FCA7D (categori_id), PRIMARY KEY(proprietes_id, categori_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categori (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE proprietes_categori ADD CONSTRAINT FK_5375D448A1005530 FOREIGN KEY (proprietes_id) REFERENCES proprietes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE proprietes_categori ADD CONSTRAINT FK_5375D448425FCA7D FOREIGN KEY (categori_id) REFERENCES categori (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE proprietes_categori DROP FOREIGN KEY FK_5375D448425FCA7D');
        $this->addSql('DROP TABLE proprietes_categori');
        $this->addSql('DROP TABLE categori');
    }
}
