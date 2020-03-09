<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200309115934 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE server_software (server_id INT NOT NULL, software_id INT NOT NULL, INDEX IDX_B575E9731844E6B7 (server_id), INDEX IDX_B575E973D7452741 (software_id), PRIMARY KEY(server_id, software_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE server_software ADD CONSTRAINT FK_B575E9731844E6B7 FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE server_software ADD CONSTRAINT FK_B575E973D7452741 FOREIGN KEY (software_id) REFERENCES software (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE software_server');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE software_server (software_id INT NOT NULL, server_id INT NOT NULL, INDEX IDX_2B1B75CD7452741 (software_id), INDEX IDX_2B1B75C1844E6B7 (server_id), PRIMARY KEY(software_id, server_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE software_server ADD CONSTRAINT FK_2B1B75C1844E6B7 FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE software_server ADD CONSTRAINT FK_2B1B75CD7452741 FOREIGN KEY (software_id) REFERENCES software (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE server_software');
    }
}
