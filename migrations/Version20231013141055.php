<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231013141055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE public_formation (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, titre VARCHAR(255) NOT NULL, ordre INT NOT NULL, INDEX IDX_6D67FA3E5200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE public_formation ADD CONSTRAINT FK_6D67FA3E5200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE public_formatique DROP FOREIGN KEY FK_915845EB5200282E');
        $this->addSql('DROP TABLE public_formatique');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE public_formatique (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ordre INT NOT NULL, INDEX IDX_915845EB5200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE public_formatique ADD CONSTRAINT FK_915845EB5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE public_formation DROP FOREIGN KEY FK_6D67FA3E5200282E');
        $this->addSql('DROP TABLE public_formation');
    }
}
