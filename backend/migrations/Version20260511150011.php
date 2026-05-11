<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260511150011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE circuit ADD prestation_id INT NOT NULL');
        $this->addSql('ALTER TABLE circuit ADD CONSTRAINT FK_1325F3A69E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1325F3A69E45C554 ON circuit (prestation_id)');
        $this->addSql('ALTER TABLE cours_langue ADD prestation_id INT NOT NULL');
        $this->addSql('ALTER TABLE cours_langue ADD CONSTRAINT FK_FCD764E69E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FCD764E69E45C554 ON cours_langue (prestation_id)');
        $this->addSql('ALTER TABLE prestation ADD pole_id INT NOT NULL, ADD photo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FAD419C3385 FOREIGN KEY (pole_id) REFERENCES pole (id)');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FAD7E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id)');
        $this->addSql('CREATE INDEX IDX_51C88FAD419C3385 ON prestation (pole_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_51C88FAD7E9E4C8C ON prestation (photo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE circuit DROP FOREIGN KEY FK_1325F3A69E45C554');
        $this->addSql('DROP INDEX UNIQ_1325F3A69E45C554 ON circuit');
        $this->addSql('ALTER TABLE circuit DROP prestation_id');
        $this->addSql('ALTER TABLE cours_langue DROP FOREIGN KEY FK_FCD764E69E45C554');
        $this->addSql('DROP INDEX UNIQ_FCD764E69E45C554 ON cours_langue');
        $this->addSql('ALTER TABLE cours_langue DROP prestation_id');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FAD419C3385');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FAD7E9E4C8C');
        $this->addSql('DROP INDEX IDX_51C88FAD419C3385 ON prestation');
        $this->addSql('DROP INDEX UNIQ_51C88FAD7E9E4C8C ON prestation');
        $this->addSql('ALTER TABLE prestation DROP pole_id, DROP photo_id');
    }
}
