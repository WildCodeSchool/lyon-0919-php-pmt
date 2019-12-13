<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191212142746 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE adhesion_price (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE insurance (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inscription ADD insurance_id INT DEFAULT NULL, ADD adhesion_price_id INT DEFAULT NULL, CHANGE status status INT DEFAULT NULL, CHANGE internal_procedure internal_procedure VARCHAR(255) DEFAULT NULL, CHANGE medical_certificate medical_certificate VARCHAR(255) DEFAULT NULL, CHANGE inscription_sheet inscription_sheet VARCHAR(255) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE inscription_year inscription_year VARCHAR(12) DEFAULT NULL, CHANGE image_right image_right TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6D1E63CD1 FOREIGN KEY (insurance_id) REFERENCES insurance (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6F50F4217 FOREIGN KEY (adhesion_price_id) REFERENCES adhesion_price (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6D1E63CD1 ON inscription (insurance_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6F50F4217 ON inscription (adhesion_price_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6F50F4217');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6D1E63CD1');
        $this->addSql('DROP TABLE adhesion_price');
        $this->addSql('DROP TABLE insurance');
        $this->addSql('DROP INDEX IDX_5E90F6D6D1E63CD1 ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D6F50F4217 ON inscription');
        $this->addSql('ALTER TABLE inscription DROP insurance_id, DROP adhesion_price_id, CHANGE status status INT NOT NULL, CHANGE internal_procedure internal_procedure VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE medical_certificate medical_certificate VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE inscription_sheet inscription_sheet VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL, CHANGE inscription_year inscription_year VARCHAR(12) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_right image_right TINYINT(1) NOT NULL');
    }
}
