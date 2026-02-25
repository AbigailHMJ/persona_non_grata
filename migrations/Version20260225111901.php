<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260225111901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE has_campaign (has_id INT NOT NULL, campaign_id INT NOT NULL, INDEX IDX_E73E8E911BD6139 (has_id), INDEX IDX_E73E8E9F639F774 (campaign_id), PRIMARY KEY (has_id, campaign_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE has_genres (has_id INT NOT NULL, genres_id INT NOT NULL, INDEX IDX_84C9F28D11BD6139 (has_id), INDEX IDX_84C9F28D6A3B2603 (genres_id), PRIMARY KEY (has_id, genres_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE share_user (share_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_3054DBD02AE63FDB (share_id), INDEX IDX_3054DBD0A76ED395 (user_id), PRIMARY KEY (share_id, user_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE share_campaign (share_id INT NOT NULL, campaign_id INT NOT NULL, INDEX IDX_E6EEA1182AE63FDB (share_id), INDEX IDX_E6EEA118F639F774 (campaign_id), PRIMARY KEY (share_id, campaign_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE has_campaign ADD CONSTRAINT FK_E73E8E911BD6139 FOREIGN KEY (has_id) REFERENCES has (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE has_campaign ADD CONSTRAINT FK_E73E8E9F639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE has_genres ADD CONSTRAINT FK_84C9F28D11BD6139 FOREIGN KEY (has_id) REFERENCES has (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE has_genres ADD CONSTRAINT FK_84C9F28D6A3B2603 FOREIGN KEY (genres_id) REFERENCES genres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE share_user ADD CONSTRAINT FK_3054DBD02AE63FDB FOREIGN KEY (share_id) REFERENCES share (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE share_user ADD CONSTRAINT FK_3054DBD0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE share_campaign ADD CONSTRAINT FK_E6EEA1182AE63FDB FOREIGN KEY (share_id) REFERENCES share (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE share_campaign ADD CONSTRAINT FK_E6EEA118F639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE addons ADD has_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE addons ADD CONSTRAINT FK_DB65263711BD6139 FOREIGN KEY (has_id) REFERENCES `character` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DB65263711BD6139 ON addons (has_id)');
        $this->addSql('ALTER TABLE `character` ADD has_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB03411BD6139 FOREIGN KEY (has_id) REFERENCES campaign (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_937AB03411BD6139 ON `character` (has_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE has_campaign DROP FOREIGN KEY FK_E73E8E911BD6139');
        $this->addSql('ALTER TABLE has_campaign DROP FOREIGN KEY FK_E73E8E9F639F774');
        $this->addSql('ALTER TABLE has_genres DROP FOREIGN KEY FK_84C9F28D11BD6139');
        $this->addSql('ALTER TABLE has_genres DROP FOREIGN KEY FK_84C9F28D6A3B2603');
        $this->addSql('ALTER TABLE share_user DROP FOREIGN KEY FK_3054DBD02AE63FDB');
        $this->addSql('ALTER TABLE share_user DROP FOREIGN KEY FK_3054DBD0A76ED395');
        $this->addSql('ALTER TABLE share_campaign DROP FOREIGN KEY FK_E6EEA1182AE63FDB');
        $this->addSql('ALTER TABLE share_campaign DROP FOREIGN KEY FK_E6EEA118F639F774');
        $this->addSql('DROP TABLE has_campaign');
        $this->addSql('DROP TABLE has_genres');
        $this->addSql('DROP TABLE share_user');
        $this->addSql('DROP TABLE share_campaign');
        $this->addSql('ALTER TABLE addons DROP FOREIGN KEY FK_DB65263711BD6139');
        $this->addSql('DROP INDEX UNIQ_DB65263711BD6139 ON addons');
        $this->addSql('ALTER TABLE addons DROP has_id');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB03411BD6139');
        $this->addSql('DROP INDEX UNIQ_937AB03411BD6139 ON `character`');
        $this->addSql('ALTER TABLE `character` DROP has_id');
    }
}
