<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231013141951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chapitre_module_formation (id INT AUTO_INCREMENT NOT NULL, module_formation_id INT NOT NULL, titre VARCHAR(255) NOT NULL, ordre INT NOT NULL, INDEX IDX_8736B71F3A53B0DC (module_formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chapitre_module_formation ADD CONSTRAINT FK_8736B71F3A53B0DC FOREIGN KEY (module_formation_id) REFERENCES module_formation (id)');
        $this->addSql('ALTER TABLE module_chapitre_formation DROP FOREIGN KEY FK_17E441FC3A53B0DC');
        $this->addSql('DROP TABLE module_chapitre_formation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE module_chapitre_formation (id INT AUTO_INCREMENT NOT NULL, module_formation_id INT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ordre INT NOT NULL, INDEX IDX_17E441FC3A53B0DC (module_formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE module_chapitre_formation ADD CONSTRAINT FK_17E441FC3A53B0DC FOREIGN KEY (module_formation_id) REFERENCES module_formation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE chapitre_module_formation DROP FOREIGN KEY FK_8736B71F3A53B0DC');
        $this->addSql('DROP TABLE chapitre_module_formation');
    }
}
