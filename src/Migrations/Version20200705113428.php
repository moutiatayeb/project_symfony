<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200705113428 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD questions_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BCB134CE FOREIGN KEY (questions_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649BCB134CE ON user (questions_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BCB134CE');
        $this->addSql('DROP INDEX IDX_8D93D649BCB134CE ON user');
        $this->addSql('ALTER TABLE user DROP questions_id, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
