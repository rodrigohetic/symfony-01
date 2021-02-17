<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217134151 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beer ADD price NUMERIC(5, 2) DEFAULT NULL, CHANGE country_id country_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE published_at published_at DATETIME DEFAULT NULL, CHANGE degree degree DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE category CHANGE term term VARCHAR(100) DEFAULT \'normal\' NOT NULL');
        $this->addSql('ALTER TABLE client CHANGE weight weight NUMERIC(4, 1) DEFAULT NULL, CHANGE number_beer number_beer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE country CHANGE email email VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE statistic CHANGE beer_id_id beer_id_id INT DEFAULT NULL, CHANGE cliend_id_id cliend_id_id INT DEFAULT NULL, CHANGE score score INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beer DROP price, CHANGE country_id country_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE published_at published_at DATETIME DEFAULT \'NULL\', CHANGE degree degree DOUBLE PRECISION DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE category CHANGE term term VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'\'\'normal\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE client CHANGE weight weight NUMERIC(4, 1) DEFAULT \'NULL\', CHANGE number_beer number_beer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE country CHANGE email email VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE statistic CHANGE beer_id_id beer_id_id INT DEFAULT NULL, CHANGE cliend_id_id cliend_id_id INT DEFAULT NULL, CHANGE score score INT DEFAULT NULL');
    }
}
