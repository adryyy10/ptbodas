<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201205092615 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE peticiones (id INT AUTO_INCREMENT NOT NULL, ascensor_id INT DEFAULT NULL, inicio VARCHAR(255) NOT NULL, final VARCHAR(255) NOT NULL, origen VARCHAR(255) NOT NULL, destino VARCHAR(255) NOT NULL, distancia VARCHAR(255) NOT NULL, INDEX IDX_DFCB698AF2D094F (ascensor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE peticiones ADD CONSTRAINT FK_DFCB698AF2D094F FOREIGN KEY (ascensor_id) REFERENCES ascensores (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE peticiones');
    }
}
