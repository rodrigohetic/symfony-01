<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210217142546 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beer CHANGE country_id country_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE published_at published_at DATETIME DEFAULT NULL, CHANGE degree degree DOUBLE PRECISION DEFAULT NULL, CHANGE price price NUMERIC(5, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE category CHANGE term term VARCHAR(100) DEFAULT \'normal\' NOT NULL');
        $this->addSql('ALTER TABLE client CHANGE weight weight NUMERIC(4, 1) DEFAULT NULL, CHANGE number_beer number_beer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE country CHANGE email email VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469C872EC465');
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469CBBF79E2E');
        $this->addSql('DROP INDEX IDX_649B469CBBF79E2E ON statistic');
        $this->addSql('DROP INDEX IDX_649B469C872EC465 ON statistic');
        $this->addSql('ALTER TABLE statistic ADD beer_id INT DEFAULT NULL, ADD client_id INT DEFAULT NULL, DROP beer_id_id, DROP cliend_id_id, CHANGE score score INT DEFAULT NULL');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CD0989053 FOREIGN KEY (beer_id) REFERENCES beer (id)');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_649B469CD0989053 ON statistic (beer_id)');
        $this->addSql('CREATE INDEX IDX_649B469C19EB6921 ON statistic (client_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE beer CHANGE country_id country_id INT DEFAULT NULL, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE published_at published_at DATETIME DEFAULT \'NULL\', CHANGE degree degree DOUBLE PRECISION DEFAULT \'NULL\', CHANGE price price NUMERIC(5, 2) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE category CHANGE term term VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'\'\'normal\'\'\' NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE client CHANGE weight weight NUMERIC(4, 1) DEFAULT \'NULL\', CHANGE number_beer number_beer INT DEFAULT NULL');
        $this->addSql('ALTER TABLE country CHANGE email email VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469CD0989053');
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469C19EB6921');
        $this->addSql('DROP INDEX IDX_649B469CD0989053 ON statistic');
        $this->addSql('DROP INDEX IDX_649B469C19EB6921 ON statistic');
        $this->addSql('ALTER TABLE statistic ADD beer_id_id INT DEFAULT NULL, ADD cliend_id_id INT DEFAULT NULL, DROP beer_id, DROP client_id, CHANGE score score INT DEFAULT NULL');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469C872EC465 FOREIGN KEY (beer_id_id) REFERENCES beer (id)');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CBBF79E2E FOREIGN KEY (cliend_id_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_649B469CBBF79E2E ON statistic (cliend_id_id)');
        $this->addSql('CREATE INDEX IDX_649B469C872EC465 ON statistic (beer_id_id)');
    }
}
