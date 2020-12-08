<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201208091847 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE distancia_ascensor_solicitud ADD ascensor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE distancia_ascensor_solicitud ADD CONSTRAINT FK_485EF1DDF2D094F FOREIGN KEY (ascensor_id) REFERENCES ascensores (id)');
        $this->addSql('CREATE INDEX IDX_485EF1DDF2D094F ON distancia_ascensor_solicitud (ascensor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE distancia_ascensor_solicitud DROP FOREIGN KEY FK_485EF1DDF2D094F');
        $this->addSql('DROP INDEX IDX_485EF1DDF2D094F ON distancia_ascensor_solicitud');
        $this->addSql('ALTER TABLE distancia_ascensor_solicitud DROP ascensor_id');
    }
}
