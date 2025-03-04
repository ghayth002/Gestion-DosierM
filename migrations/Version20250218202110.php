<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250218202110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, date DATETIME NOT NULL, patient_identifier VARCHAR(255) NOT NULL, INDEX IDX_964685A6ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, nbr_etage INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dossier_medicale (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, medecin_id INT NOT NULL, date_de_creation DATETIME NOT NULL, historique_des_maladies LONGTEXT DEFAULT NULL, operations_passees LONGTEXT DEFAULT NULL, consultations_passees LONGTEXT DEFAULT NULL, statut_dossier VARCHAR(255) NOT NULL, notes LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_4C53FBC06B899279 (patient_id), INDEX IDX_4C53FBC04F31A84 (medecin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sejour (id INT AUTO_INCREMENT NOT NULL, dossier_medicale_id INT NOT NULL, date_entree DATETIME NOT NULL, date_sortie DATETIME NOT NULL, type_sejour VARCHAR(255) NOT NULL, frais_sejour DOUBLE PRECISION NOT NULL, moyen_paiement VARCHAR(255) NOT NULL, statut_paiement VARCHAR(255) NOT NULL, prix_extras DOUBLE PRECISION DEFAULT NULL, INDEX IDX_96F52028F2C46B04 (dossier_medicale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (Id_User INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, Nom_User VARCHAR(255) NOT NULL, Prenom_User VARCHAR(255) NOT NULL, Num_Telephone VARCHAR(20) NOT NULL, sexe VARCHAR(1) NOT NULL, addresse VARCHAR(255) NOT NULL, Date_Naissance DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(Id_User)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE dossier_medicale ADD CONSTRAINT FK_4C53FBC06B899279 FOREIGN KEY (patient_id) REFERENCES `user` (Id_User)');
        $this->addSql('ALTER TABLE dossier_medicale ADD CONSTRAINT FK_4C53FBC04F31A84 FOREIGN KEY (medecin_id) REFERENCES `user` (Id_User)');
        $this->addSql('ALTER TABLE sejour ADD CONSTRAINT FK_96F52028F2C46B04 FOREIGN KEY (dossier_medicale_id) REFERENCES dossier_medicale (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6ED5CA9E6');
        $this->addSql('ALTER TABLE dossier_medicale DROP FOREIGN KEY FK_4C53FBC06B899279');
        $this->addSql('ALTER TABLE dossier_medicale DROP FOREIGN KEY FK_4C53FBC04F31A84');
        $this->addSql('ALTER TABLE sejour DROP FOREIGN KEY FK_96F52028F2C46B04');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE dossier_medicale');
        $this->addSql('DROP TABLE sejour');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
