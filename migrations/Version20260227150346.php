<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260227150346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campaign ADD shared_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE campaign ADD CONSTRAINT FK_1F1512DD3B943F60 FOREIGN KEY (shared_id) REFERENCES share (id)');
        $this->addSql('CREATE INDEX IDX_1F1512DD3B943F60 ON campaign (shared_id)');
        $this->addSql('ALTER TABLE share ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE share ADD CONSTRAINT FK_EF069D5AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EF069D5AA76ED395 ON share (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campaign DROP FOREIGN KEY FK_1F1512DD3B943F60');
        $this->addSql('DROP INDEX IDX_1F1512DD3B943F60 ON campaign');
        $this->addSql('ALTER TABLE campaign DROP shared_id');
        $this->addSql('ALTER TABLE share DROP FOREIGN KEY FK_EF069D5AA76ED395');
        $this->addSql('DROP INDEX IDX_EF069D5AA76ED395 ON share');
        $this->addSql('ALTER TABLE share DROP user_id');
    }
}
