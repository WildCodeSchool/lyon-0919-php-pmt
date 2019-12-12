<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191211112037 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inscription ADD adhesion_price_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6F50F4217 FOREIGN KEY (adhesion_price_id) REFERENCES adhesion_price (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6F50F4217 ON inscription (adhesion_price_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6F50F4217');
        $this->addSql('DROP INDEX IDX_5E90F6D6F50F4217 ON inscription');
        $this->addSql('ALTER TABLE inscription DROP adhesion_price_id');
    }
}
