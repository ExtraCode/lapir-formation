<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231107142324 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formation_formation DROP FOREIGN KEY FK_8A3D7162667621D1');
        $this->addSql('ALTER TABLE formation_formation DROP FOREIGN KEY FK_8A3D71627F93715E');
        $this->addSql('DROP TABLE formation_formation');
        $this->addSql('ALTER TABLE formation ADD nb_apprenant INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation_formation (formation_source INT NOT NULL, formation_target INT NOT NULL, INDEX IDX_8A3D7162667621D1 (formation_target), INDEX IDX_8A3D71627F93715E (formation_source), PRIMARY KEY(formation_source, formation_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE formation_formation ADD CONSTRAINT FK_8A3D7162667621D1 FOREIGN KEY (formation_target) REFERENCES formation (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_formation ADD CONSTRAINT FK_8A3D71627F93715E FOREIGN KEY (formation_source) REFERENCES formation (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation DROP nb_apprenant');
    }
}
