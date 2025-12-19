<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251218153009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation_thematique_formation (formation_id INT NOT NULL, thematique_formation_id INT NOT NULL, INDEX IDX_3434FF8C5200282E (formation_id), INDEX IDX_3434FF8CDF15B99C (thematique_formation_id), PRIMARY KEY (formation_id, thematique_formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE formation_thematique_formation ADD CONSTRAINT FK_3434FF8C5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_thematique_formation ADD CONSTRAINT FK_3434FF8CDF15B99C FOREIGN KEY (thematique_formation_id) REFERENCES thematique_formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY `FK_404021BF476556AF`');
        $this->addSql('DROP INDEX IDX_404021BF476556AF ON formation');
        $this->addSql('ALTER TABLE formation DROP thematique_id');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_404021BFAEA34913 ON formation (reference)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation_thematique_formation DROP FOREIGN KEY FK_3434FF8C5200282E');
        $this->addSql('ALTER TABLE formation_thematique_formation DROP FOREIGN KEY FK_3434FF8CDF15B99C');
        $this->addSql('DROP TABLE formation_thematique_formation');
        $this->addSql('DROP INDEX UNIQ_404021BFAEA34913 ON formation');
        $this->addSql('ALTER TABLE formation ADD thematique_id INT NOT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT `FK_404021BF476556AF` FOREIGN KEY (thematique_id) REFERENCES thematique_formation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_404021BF476556AF ON formation (thematique_id)');
    }
}
