<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200618131843 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE formateur_condidat');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C155D8F51');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C1619DB31');
        $this->addSql('DROP INDEX IDX_FDCA8C9C1619DB31 ON cours');
        $this->addSql('DROP INDEX IDX_FDCA8C9C155D8F51 ON cours');
        $this->addSql('ALTER TABLE cours DROP formateur_id, DROP condidat_id');
        $this->addSql('ALTER TABLE formateur CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E7ECF78B0');
        $this->addSql('DROP INDEX IDX_B6F7494E7ECF78B0 ON question');
        $this->addSql('ALTER TABLE question DROP cours_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE formateur_condidat (formateur_id INT NOT NULL, condidat_id INT NOT NULL, INDEX IDX_89D92875155D8F51 (formateur_id), INDEX IDX_89D928751619DB31 (condidat_id), PRIMARY KEY(formateur_id, condidat_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE formateur_condidat ADD CONSTRAINT FK_89D92875155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formateur_condidat ADD CONSTRAINT FK_89D928751619DB31 FOREIGN KEY (condidat_id) REFERENCES condidat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours ADD formateur_id INT DEFAULT NULL, ADD condidat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C1619DB31 FOREIGN KEY (condidat_id) REFERENCES condidat (id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9C1619DB31 ON cours (condidat_id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9C155D8F51 ON cours (formateur_id)');
        $this->addSql('ALTER TABLE formateur CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
        $this->addSql('ALTER TABLE question ADD cours_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494E7ECF78B0 ON question (cours_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
