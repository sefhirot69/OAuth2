<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240125190316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create auth_token and auth_refresh_token tables';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auth_refresh_token (id UUID NOT NULL, token_id UUID NOT NULL, expires_in TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C0DCFD8541DEE7B9 ON auth_refresh_token (token_id)');
        $this->addSql('COMMENT ON COLUMN auth_refresh_token.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN auth_refresh_token.token_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN auth_refresh_token.expires_in IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE auth_token (id UUID NOT NULL, client_id UUID NOT NULL, expires_in TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9315F04E19EB6921 ON auth_token (client_id)');
        $this->addSql('COMMENT ON COLUMN auth_token.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN auth_token.client_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN auth_token.expires_in IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE auth_refresh_token ADD CONSTRAINT FK_C0DCFD8541DEE7B9 FOREIGN KEY (token_id) REFERENCES auth_token (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE auth_token ADD CONSTRAINT FK_9315F04E19EB6921 FOREIGN KEY (client_id) REFERENCES auth_client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE auth_client ALTER grants TYPE JSON');
        $this->addSql('ALTER TABLE auth_client ALTER scopes TYPE JSON');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE auth_refresh_token DROP CONSTRAINT FK_C0DCFD8541DEE7B9');
        $this->addSql('ALTER TABLE auth_token DROP CONSTRAINT FK_9315F04E19EB6921');
        $this->addSql('DROP TABLE auth_refresh_token');
        $this->addSql('DROP TABLE auth_token');
        $this->addSql('ALTER TABLE auth_client ALTER grants TYPE JSON');
        $this->addSql('ALTER TABLE auth_client ALTER scopes TYPE JSON');
    }
}
