<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200308171116 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE software (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE software_server (software_id INT NOT NULL, server_id INT NOT NULL, INDEX IDX_2B1B75CD7452741 (software_id), INDEX IDX_2B1B75C1844E6B7 (server_id), PRIMARY KEY(software_id, server_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE software_server ADD CONSTRAINT FK_2B1B75CD7452741 FOREIGN KEY (software_id) REFERENCES software (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE software_server ADD CONSTRAINT FK_2B1B75C1844E6B7 FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE software_server DROP FOREIGN KEY FK_2B1B75CD7452741');
        $this->addSql('DROP TABLE software');
        $this->addSql('DROP TABLE software_server');
    }
}
