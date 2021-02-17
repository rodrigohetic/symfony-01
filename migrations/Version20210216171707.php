<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216171707 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, weight NUMERIC(4, 1) DEFAULT NULL, name VARCHAR(100) NOT NULL, number_beer INT DEFAULT NULL, age INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistic (id INT AUTO_INCREMENT NOT NULL, beer_id_id INT DEFAULT NULL, cliend_id_id INT DEFAULT NULL, score INT DEFAULT NULL, INDEX IDX_649B469C872EC465 (beer_id_id), INDEX IDX_649B469CBBF79E2E (cliend_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469C872EC465 FOREIGN KEY (beer_id_id) REFERENCES beer (id)');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CBBF79E2E FOREIGN KEY (cliend_id_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE beer CHANGE country_id country_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE published_at published_at DATETIME DEFAULT NULL, CHANGE degree degree DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE category CHANGE term term VARCHAR(100) DEFAULT \'normal\' NOT NULL');
        $this->addSql('ALTER TABLE country CHANGE email email VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469CBBF79E2E');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE statistic');
        $this->addSql('ALTER TABLE beer CHANGE country_id country_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE published_at published_at DATETIME DEFAULT \'NULL\', CHANGE degree degree DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE category CHANGE term term VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'\'\'normal\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE country CHANGE email email VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
