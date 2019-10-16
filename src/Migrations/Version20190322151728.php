<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190322151728 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE world_draw DROP wording');
        $this->addSql('ALTER TABLE theme_draw DROP background_question_path, DROP background_question_success_path, DROP background_question_error_path');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE theme_draw ADD background_question_path VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD background_question_success_path VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD background_question_error_path VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE world_draw ADD wording VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
