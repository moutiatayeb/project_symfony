<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200705192724 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BCB134CE');
        $this->addSql('DROP INDEX IDX_8D93D649BCB134CE ON user');
        $this->addSql('ALTER TABLE user DROP questions_id, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE reponse ADD reponse_user VARCHAR(255) NOT NULL, ADD date VARCHAR(255) NOT NULL, DROP id_user, DROP id_question, DROP reponse');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reponse ADD id_user VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD id_question VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD reponse VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP reponse_user, DROP date');
        $this->addSql('ALTER TABLE user ADD questions_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BCB134CE FOREIGN KEY (questions_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649BCB134CE ON user (questions_id)');
    }
}
