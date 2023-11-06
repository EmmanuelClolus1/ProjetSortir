<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231102093618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participant_sortie DROP FOREIGN KEY FK_8E436D739D1C3019');
        $this->addSql('ALTER TABLE participant_sortie DROP FOREIGN KEY FK_8E436D73CC72D953');
        $this->addSql('DROP TABLE participant_sortie');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11AF5D55E1');
        $this->addSql('DROP INDEX IDX_D79F6B11AF5D55E1 ON participant');
        $this->addSql('DROP INDEX UNIQ_D79F6B11450FF010 ON participant');
        $this->addSql('DROP INDEX UNIQ_D79F6B115126AC48 ON participant');
        $this->addSql('ALTER TABLE participant ADD email VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL, DROP campus_id, DROP mail, DROP mot_passe, CHANGE telephone telephone VARCHAR(20) DEFAULT NULL, CHANGE administrateur administrateur TINYINT(1) NOT NULL, CHANGE actif actif TINYINT(1) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D79F6B11E7927C74 ON participant (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participant_sortie (participant_id INT NOT NULL, sortie_id INT NOT NULL, INDEX IDX_8E436D739D1C3019 (participant_id), INDEX IDX_8E436D73CC72D953 (sortie_id), PRIMARY KEY(participant_id, sortie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE participant_sortie ADD CONSTRAINT FK_8E436D739D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participant_sortie ADD CONSTRAINT FK_8E436D73CC72D953 FOREIGN KEY (sortie_id) REFERENCES sortie (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_D79F6B11E7927C74 ON participant');
        $this->addSql('ALTER TABLE participant ADD campus_id INT DEFAULT NULL, ADD mail VARCHAR(50) NOT NULL, ADD mot_passe VARCHAR(50) NOT NULL, DROP email, DROP roles, DROP password, CHANGE telephone telephone VARCHAR(50) DEFAULT NULL, CHANGE administrateur administrateur TINYINT(1) DEFAULT 0 NOT NULL, CHANGE actif actif TINYINT(1) DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11AF5D55E1 FOREIGN KEY (campus_id) REFERENCES campus (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D79F6B11AF5D55E1 ON participant (campus_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D79F6B11450FF010 ON participant (telephone)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D79F6B115126AC48 ON participant (mail)');
    }
}
