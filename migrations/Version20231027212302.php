<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231027212302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auth_client (id UUID NOT NULL, grants JSON NOT NULL, redirect_uris JSON DEFAULT NULL, scopes JSON NOT NULL, active BOOLEAN NOT NULL, identifier VARCHAR(32) NOT NULL, name VARCHAR(128) NOT NULL, secret VARCHAR(128) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E7E7A3B7772E836A ON auth_client (identifier)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E7E7A3B75E237E06 ON auth_client (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E7E7A3B75CA2E8E5 ON auth_client (secret)');
        $this->addSql('COMMENT ON COLUMN auth_client.id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE auth_client');
    }
}
