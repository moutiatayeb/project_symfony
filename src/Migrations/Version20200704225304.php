<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200704225304 extends AbstractMigration
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
        $this->addSql('ALTER TABLE condidat DROP FOREIGN KEY FK_3A8ACF2C7ECF78B0');
        $this->addSql('DROP INDEX FK_3A8ACF2C7ECF78B0 ON condidat');
        $this->addSql('ALTER TABLE condidat DROP cours_id');
        $this->addSql('ALTER TABLE formateur DROP email, DROP username, DROP password, DROP roles');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE formateur_condidat (formateur_id INT NOT NULL, condidat_id INT NOT NULL, INDEX IDX_89D928751619DB31 (condidat_id), INDEX IDX_89D92875155D8F51 (formateur_id), PRIMARY KEY(formateur_id, condidat_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE formateur_condidat ADD CONSTRAINT FK_89D92875155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formateur_condidat ADD CONSTRAINT FK_89D928751619DB31 FOREIGN KEY (condidat_id) REFERENCES condidat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE condidat ADD cours_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE condidat ADD CONSTRAINT FK_3A8ACF2C7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX FK_3A8ACF2C7ECF78B0 ON condidat (cours_id)');
        $this->addSql('ALTER TABLE formateur ADD email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD username VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
