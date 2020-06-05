<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200604222328 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cours CHANGE formateur_id formateur_id INT DEFAULT NULL, CHANGE condidat_id condidat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD cours_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494E7ECF78B0 ON question (cours_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cours CHANGE formateur_id formateur_id INT DEFAULT NULL, CHANGE condidat_id condidat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E7ECF78B0');
        $this->addSql('DROP INDEX IDX_B6F7494E7ECF78B0 ON question');
        $this->addSql('ALTER TABLE question DROP cours_id');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
