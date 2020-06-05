<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200604221737 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE condidat (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, date_creation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, formateur_id INT DEFAULT NULL, condidat_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, date_creation_cours VARCHAR(255) NOT NULL, INDEX IDX_FDCA8C9C155D8F51 (formateur_id), INDEX IDX_FDCA8C9C1619DB31 (condidat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formateur_condidat (formateur_id INT NOT NULL, condidat_id INT NOT NULL, INDEX IDX_89D92875155D8F51 (formateur_id), INDEX IDX_89D928751619DB31 (condidat_id), PRIMARY KEY(formateur_id, condidat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, choix_a VARCHAR(255) NOT NULL, choix_b VARCHAR(255) NOT NULL, choix_c VARCHAR(255) NOT NULL, repense VARCHAR(255) NOT NULL, date_repense VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C1619DB31 FOREIGN KEY (condidat_id) REFERENCES condidat (id)');
        $this->addSql('ALTER TABLE formateur_condidat ADD CONSTRAINT FK_89D92875155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formateur_condidat ADD CONSTRAINT FK_89D928751619DB31 FOREIGN KEY (condidat_id) REFERENCES condidat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C1619DB31');
        $this->addSql('ALTER TABLE formateur_condidat DROP FOREIGN KEY FK_89D928751619DB31');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C155D8F51');
        $this->addSql('ALTER TABLE formateur_condidat DROP FOREIGN KEY FK_89D92875155D8F51');
        $this->addSql('DROP TABLE condidat');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE formateur');
        $this->addSql('DROP TABLE formateur_condidat');
        $this->addSql('DROP TABLE question');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
