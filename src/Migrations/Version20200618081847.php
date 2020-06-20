<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200618081847 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C1E27F6BF');
        $this->addSql('DROP INDEX IDX_FDCA8C9C1E27F6BF ON cours');
        $this->addSql('ALTER TABLE cours DROP question_id, CHANGE formateur_id formateur_id INT DEFAULT NULL, CHANGE condidat_id condidat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formateur ADD email VARCHAR(255) NOT NULL, ADD username VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD roles JSON NOT NULL');
        $this->addSql('ALTER TABLE question ADD question VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cours ADD question_id INT DEFAULT NULL, CHANGE formateur_id formateur_id INT DEFAULT NULL, CHANGE condidat_id condidat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9C1E27F6BF ON cours (question_id)');
        $this->addSql('ALTER TABLE formateur DROP email, DROP username, DROP password, DROP roles');
        $this->addSql('ALTER TABLE question DROP question');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
