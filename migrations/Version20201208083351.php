<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201208083351 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE distancia_ascensor_solicitud (id INT AUTO_INCREMENT NOT NULL, ascensor_id INT DEFAULT NULL, distancia_total VARCHAR(255) NOT NULL, peticion VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_485EF1DDF2D094F (ascensor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE distancia_ascensor_solicitud ADD CONSTRAINT FK_485EF1DDF2D094F FOREIGN KEY (ascensor_id) REFERENCES ascensores (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE distancia_ascensor_solicitud');
    }
}
