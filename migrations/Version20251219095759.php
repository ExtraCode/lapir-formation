<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251219095759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chapitre_module_formation CHANGE titre nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE formation_thematique_formation ADD CONSTRAINT FK_3434FF8C5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_thematique_formation ADD CONSTRAINT FK_3434FF8CDF15B99C FOREIGN KEY (thematique_formation_id) REFERENCES thematique_formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module_formation CHANGE titre nom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chapitre_module_formation CHANGE nom titre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE formation_thematique_formation DROP FOREIGN KEY FK_3434FF8C5200282E');
        $this->addSql('ALTER TABLE formation_thematique_formation DROP FOREIGN KEY FK_3434FF8CDF15B99C');
        $this->addSql('ALTER TABLE module_formation CHANGE nom titre VARCHAR(255) NOT NULL');
    }
}
