<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231013125146 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis_formation (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, prenom_auteur VARCHAR(50) NOT NULL, nom_auteur VARCHAR(50) NOT NULL, note INT NOT NULL, texte_sur_formateur LONGTEXT DEFAULT NULL, texte_sur_contenu LONGTEXT DEFAULT NULL, texte_sur_salle LONGTEXT DEFAULT NULL, texte_sur_plus_apprecie LONGTEXT NOT NULL, texte_sur_moins_apprecie LONGTEXT NOT NULL, INDEX IDX_E6153E7E5200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domaine_formation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, thematique_id INT NOT NULL, niveau_id INT NOT NULL, titre VARCHAR(255) NOT NULL, reference VARCHAR(10) NOT NULL, courte_description LONGTEXT NOT NULL, duree_heures INT NOT NULL, description LONGTEXT NOT NULL, prix INT NOT NULL, eligible_cpf TINYINT(1) NOT NULL, INDEX IDX_404021BF476556AF (thematique_id), INDEX IDX_404021BFB3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_formation (formation_source INT NOT NULL, formation_target INT NOT NULL, INDEX IDX_8A3D71627F93715E (formation_source), INDEX IDX_8A3D7162667621D1 (formation_target), PRIMARY KEY(formation_source, formation_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription_inter_formation (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(15) DEFAULT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, type VARCHAR(50) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal VARCHAR(7) NOT NULL, ville VARCHAR(70) NOT NULL, message LONGTEXT DEFAULT NULL, communication VARCHAR(255) NOT NULL, INDEX IDX_E01F381C5200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module_chapitre_formation (id INT AUTO_INCREMENT NOT NULL, module_formation_id INT NOT NULL, titre VARCHAR(255) NOT NULL, ordre INT NOT NULL, INDEX IDX_17E441FC3A53B0DC (module_formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module_formation (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, titre VARCHAR(255) NOT NULL, ordre INT NOT NULL, INDEX IDX_1A213E775200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau_formation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objectif_formation (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, texte VARCHAR(255) NOT NULL, ordre INT NOT NULL, INDEX IDX_400F6A95200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prerequis_formation (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, titre VARCHAR(255) NOT NULL, ordre INT NOT NULL, INDEX IDX_2C9856195200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE public_formatique (id INT AUTO_INCREMENT NOT NULL, formation_id INT NOT NULL, titre VARCHAR(255) NOT NULL, ordre INT NOT NULL, INDEX IDX_915845EB5200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thematique_formation (id INT AUTO_INCREMENT NOT NULL, domaine_id INT NOT NULL, INDEX IDX_A361A3054272FC9F (domaine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis_formation ADD CONSTRAINT FK_E6153E7E5200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF476556AF FOREIGN KEY (thematique_id) REFERENCES thematique_formation (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BFB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau_formation (id)');
        $this->addSql('ALTER TABLE formation_formation ADD CONSTRAINT FK_8A3D71627F93715E FOREIGN KEY (formation_source) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_formation ADD CONSTRAINT FK_8A3D7162667621D1 FOREIGN KEY (formation_target) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription_inter_formation ADD CONSTRAINT FK_E01F381C5200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE module_chapitre_formation ADD CONSTRAINT FK_17E441FC3A53B0DC FOREIGN KEY (module_formation_id) REFERENCES module_formation (id)');
        $this->addSql('ALTER TABLE module_formation ADD CONSTRAINT FK_1A213E775200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE objectif_formation ADD CONSTRAINT FK_400F6A95200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE prerequis_formation ADD CONSTRAINT FK_2C9856195200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE public_formatique ADD CONSTRAINT FK_915845EB5200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE thematique_formation ADD CONSTRAINT FK_A361A3054272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine_formation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis_formation DROP FOREIGN KEY FK_E6153E7E5200282E');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF476556AF');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BFB3E9C81');
        $this->addSql('ALTER TABLE formation_formation DROP FOREIGN KEY FK_8A3D71627F93715E');
        $this->addSql('ALTER TABLE formation_formation DROP FOREIGN KEY FK_8A3D7162667621D1');
        $this->addSql('ALTER TABLE inscription_inter_formation DROP FOREIGN KEY FK_E01F381C5200282E');
        $this->addSql('ALTER TABLE module_chapitre_formation DROP FOREIGN KEY FK_17E441FC3A53B0DC');
        $this->addSql('ALTER TABLE module_formation DROP FOREIGN KEY FK_1A213E775200282E');
        $this->addSql('ALTER TABLE objectif_formation DROP FOREIGN KEY FK_400F6A95200282E');
        $this->addSql('ALTER TABLE prerequis_formation DROP FOREIGN KEY FK_2C9856195200282E');
        $this->addSql('ALTER TABLE public_formatique DROP FOREIGN KEY FK_915845EB5200282E');
        $this->addSql('ALTER TABLE thematique_formation DROP FOREIGN KEY FK_A361A3054272FC9F');
        $this->addSql('DROP TABLE avis_formation');
        $this->addSql('DROP TABLE domaine_formation');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE formation_formation');
        $this->addSql('DROP TABLE inscription_inter_formation');
        $this->addSql('DROP TABLE module_chapitre_formation');
        $this->addSql('DROP TABLE module_formation');
        $this->addSql('DROP TABLE niveau_formation');
        $this->addSql('DROP TABLE objectif_formation');
        $this->addSql('DROP TABLE prerequis_formation');
        $this->addSql('DROP TABLE public_formatique');
        $this->addSql('DROP TABLE thematique_formation');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
