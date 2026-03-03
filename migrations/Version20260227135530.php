<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260227135530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campaign_genres (campaign_id INT NOT NULL, genres_id INT NOT NULL, INDEX IDX_75A89CBBF639F774 (campaign_id), INDEX IDX_75A89CBB6A3B2603 (genres_id), PRIMARY KEY (campaign_id, genres_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE share (id INT AUTO_INCREMENT NOT NULL, shared_by VARCHAR(255) NOT NULL, date_share DATE NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE campaign_genres ADD CONSTRAINT FK_75A89CBBF639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campaign_genres ADD CONSTRAINT FK_75A89CBB6A3B2603 FOREIGN KEY (genres_id) REFERENCES genres (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campaign_genres DROP FOREIGN KEY FK_75A89CBBF639F774');
        $this->addSql('ALTER TABLE campaign_genres DROP FOREIGN KEY FK_75A89CBB6A3B2603');
        $this->addSql('DROP TABLE campaign_genres');
        $this->addSql('DROP TABLE share');
    }
}
