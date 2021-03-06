<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190923094633 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_bonus_investment (user_id INT NOT NULL, bonus_investment_id INT NOT NULL, INDEX IDX_C1B62A6AA76ED395 (user_id), INDEX IDX_C1B62A6A44AB3EE4 (bonus_investment_id), PRIMARY KEY(user_id, bonus_investment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bonus_investment (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, wording VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_bonus_investment ADD CONSTRAINT FK_C1B62A6AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_bonus_investment ADD CONSTRAINT FK_C1B62A6A44AB3EE4 FOREIGN KEY (bonus_investment_id) REFERENCES bonus_investment (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_bonus_investment DROP FOREIGN KEY FK_C1B62A6A44AB3EE4');
        $this->addSql('DROP TABLE user_bonus_investment');
        $this->addSql('DROP TABLE bonus_investment');
    }
}
