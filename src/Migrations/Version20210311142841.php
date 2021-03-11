<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210311142841 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE categori_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE evenement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE message_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE proprietes_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE categori (id INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE evenement (id INT NOT NULL, iduser_id INT DEFAULT NULL, filename VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, date_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B26681E786A81FB ON evenement (iduser_id)');
        $this->addSql('CREATE TABLE message (id INT NOT NULL, iduser_id INT DEFAULT NULL, message TEXT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, objet VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6BD307F786A81FB ON message (iduser_id)');
        $this->addSql('CREATE TABLE proprietes (id INT NOT NULL, iduser_id INT DEFAULT NULL, filename VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, acteurs VARCHAR(255) NOT NULL, description TEXT NOT NULL, prix INT NOT NULL, origine VARCHAR(255) NOT NULL, realisateur VARCHAR(255) NOT NULL, datesorti_at DATE NOT NULL, datecreation_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, producteur VARCHAR(255) NOT NULL, solde BOOLEAN DEFAULT \'false\' NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, newfilm BOOLEAN DEFAULT \'false\' NOT NULL, top_film BOOLEAN DEFAULT \'false\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_727BA5AE786A81FB ON proprietes (iduser_id)');
        $this->addSql('CREATE TABLE proprietes_categori (proprietes_id INT NOT NULL, categori_id INT NOT NULL, PRIMARY KEY(proprietes_id, categori_id))');
        $this->addSql('CREATE INDEX IDX_5375D448A1005530 ON proprietes_categori (proprietes_id)');
        $this->addSql('CREATE INDEX IDX_5375D448425FCA7D ON proprietes_categori (categori_id)');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, iduser_id INT DEFAULT NULL, idproduit_id INT DEFAULT NULL, message TEXT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_42C84955786A81FB ON reservation (iduser_id)');
        $this->addSql('CREATE INDEX IDX_42C84955C29D63C1 ON reservation (idproduit_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E786A81FB FOREIGN KEY (iduser_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F786A81FB FOREIGN KEY (iduser_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proprietes ADD CONSTRAINT FK_727BA5AE786A81FB FOREIGN KEY (iduser_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proprietes_categori ADD CONSTRAINT FK_5375D448A1005530 FOREIGN KEY (proprietes_id) REFERENCES proprietes (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proprietes_categori ADD CONSTRAINT FK_5375D448425FCA7D FOREIGN KEY (categori_id) REFERENCES categori (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955786A81FB FOREIGN KEY (iduser_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955C29D63C1 FOREIGN KEY (idproduit_id) REFERENCES proprietes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE proprietes_categori DROP CONSTRAINT FK_5375D448425FCA7D');
        $this->addSql('ALTER TABLE proprietes_categori DROP CONSTRAINT FK_5375D448A1005530');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C84955C29D63C1');
        $this->addSql('ALTER TABLE evenement DROP CONSTRAINT FK_B26681E786A81FB');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307F786A81FB');
        $this->addSql('ALTER TABLE proprietes DROP CONSTRAINT FK_727BA5AE786A81FB');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C84955786A81FB');
        $this->addSql('DROP SEQUENCE categori_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE evenement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE message_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE proprietes_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP TABLE categori');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE proprietes');
        $this->addSql('DROP TABLE proprietes_categori');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE "user"');
    }
}
