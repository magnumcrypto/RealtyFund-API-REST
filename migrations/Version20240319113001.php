<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319113001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exits (exit_id INT AUTO_INCREMENT NOT NULL, id_inmueble INT NOT NULL, precio_compra NUMERIC(18, 2) NOT NULL, precio_venta NUMERIC(18, 2) NOT NULL, porcentaje_rentabilidad NUMERIC(5, 2) NOT NULL, UNIQUE INDEX UNIQ_FC22EB8817B765EC (id_inmueble), PRIMARY KEY(exit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE investments (investment_id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, saleproperty_id INT DEFAULT NULL, rentproperty_id INT DEFAULT NULL, capital_aportado NUMERIC(18, 2) NOT NULL, INDEX IDX_74FD72E06B3CA4B (id_user), INDEX IDX_74FD72E0CA8D07D0 (saleproperty_id), INDEX IDX_74FD72E09D3B47FB (rentproperty_id), PRIMARY KEY(investment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rent_property (inmueble_id INT AUTO_INCREMENT NOT NULL, tipo_inmueble VARCHAR(255) NOT NULL, precio NUMERIC(18, 2) NOT NULL, direccion VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, informacion_detallada LONGTEXT NOT NULL, zona VARCHAR(255) NOT NULL, disponibilidad TINYINT(1) DEFAULT 1 NOT NULL, imagen LONGTEXT NOT NULL, PRIMARY KEY(inmueble_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sale_property (inmueble_id INT AUTO_INCREMENT NOT NULL, tipo_inmueble VARCHAR(255) NOT NULL, precio NUMERIC(18, 2) NOT NULL, direccion VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, informacion_detallada LONGTEXT NOT NULL, zona VARCHAR(255) NOT NULL, disponibilidad TINYINT(1) DEFAULT 1 NOT NULL, imagen LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_9586F074F384BE95 (direccion), PRIMARY KEY(inmueble_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (user_id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(30) NOT NULL, apellidos VARCHAR(100) NOT NULL, direccion VARCHAR(255) NOT NULL, email VARCHAR(100) NOT NULL, telefono VARCHAR(11) NOT NULL, capital_aportado NUMERIC(18, 2) NOT NULL, edad INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exits ADD CONSTRAINT FK_FC22EB8817B765EC FOREIGN KEY (id_inmueble) REFERENCES sale_property (inmueble_id)');
        $this->addSql('ALTER TABLE investments ADD CONSTRAINT FK_74FD72E06B3CA4B FOREIGN KEY (id_user) REFERENCES user (user_id)');
        $this->addSql('ALTER TABLE investments ADD CONSTRAINT FK_74FD72E0CA8D07D0 FOREIGN KEY (saleproperty_id) REFERENCES sale_property (inmueble_id)');
        $this->addSql('ALTER TABLE investments ADD CONSTRAINT FK_74FD72E09D3B47FB FOREIGN KEY (rentproperty_id) REFERENCES rent_property (inmueble_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exits DROP FOREIGN KEY FK_FC22EB8817B765EC');
        $this->addSql('ALTER TABLE investments DROP FOREIGN KEY FK_74FD72E06B3CA4B');
        $this->addSql('ALTER TABLE investments DROP FOREIGN KEY FK_74FD72E0CA8D07D0');
        $this->addSql('ALTER TABLE investments DROP FOREIGN KEY FK_74FD72E09D3B47FB');
        $this->addSql('DROP TABLE exits');
        $this->addSql('DROP TABLE investments');
        $this->addSql('DROP TABLE rent_property');
        $this->addSql('DROP TABLE sale_property');
        $this->addSql('DROP TABLE user');
    }
}
