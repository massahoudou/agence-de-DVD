<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200426112647 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE categori (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categori_proprietes (categori_id INT NOT NULL, proprietes_id INT NOT NULL, INDEX IDX_587D182C425FCA7D (categori_id), INDEX IDX_587D182CA1005530 (proprietes_id), PRIMARY KEY(categori_id, proprietes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categori_proprietes ADD CONSTRAINT FK_587D182C425FCA7D FOREIGN KEY (categori_id) REFERENCES categori (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categori_proprietes ADD CONSTRAINT FK_587D182CA1005530 FOREIGN KEY (proprietes_id) REFERENCES proprietes (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE categori_proprietes DROP FOREIGN KEY FK_587D182C425FCA7D');
        $this->addSql('DROP TABLE categori');
        $this->addSql('DROP TABLE categori_proprietes');
    }
}
