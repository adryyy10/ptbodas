<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201208085814 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE distancia_ascensor_solicitud_ascensores (distancia_ascensor_solicitud_id INT NOT NULL, ascensores_id INT NOT NULL, INDEX IDX_E2B7DDD76264CF14 (distancia_ascensor_solicitud_id), INDEX IDX_E2B7DDD74D0F9EBE (ascensores_id), PRIMARY KEY(distancia_ascensor_solicitud_id, ascensores_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE distancia_ascensor_solicitud_ascensores ADD CONSTRAINT FK_E2B7DDD76264CF14 FOREIGN KEY (distancia_ascensor_solicitud_id) REFERENCES distancia_ascensor_solicitud (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE distancia_ascensor_solicitud_ascensores ADD CONSTRAINT FK_E2B7DDD74D0F9EBE FOREIGN KEY (ascensores_id) REFERENCES ascensores (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE distancia_ascensor_solicitud DROP FOREIGN KEY FK_485EF1DDF2D094F');
        $this->addSql('DROP INDEX UNIQ_485EF1DDF2D094F ON distancia_ascensor_solicitud');
        $this->addSql('ALTER TABLE distancia_ascensor_solicitud DROP ascensor_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE distancia_ascensor_solicitud_ascensores');
        $this->addSql('ALTER TABLE distancia_ascensor_solicitud ADD ascensor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE distancia_ascensor_solicitud ADD CONSTRAINT FK_485EF1DDF2D094F FOREIGN KEY (ascensor_id) REFERENCES ascensores (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_485EF1DDF2D094F ON distancia_ascensor_solicitud (ascensor_id)');
    }
}
