<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220216161304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipo DROP INDEX equipo_presidente_id_fk, ADD UNIQUE INDEX UNIQ_C49C530B97B7E846 (presidente_id)');
        $this->addSql('ALTER TABLE equipo CHANGE liga_id liga_id INT DEFAULT NULL, CHANGE presidente_id presidente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partido DROP INDEX local, ADD UNIQUE INDEX UNIQ_4E79750B8BD688E8 (local)');
        $this->addSql('ALTER TABLE partido DROP INDEX visitante, ADD UNIQUE INDEX UNIQ_4E79750BE3659823 (visitante)');
        $this->addSql('ALTER TABLE partido CHANGE local local INT DEFAULT NULL, CHANGE visitante visitante INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partidobidireccional DROP FOREIGN KEY partidobidireccional_ibfk_1');
        $this->addSql('ALTER TABLE partidobidireccional DROP FOREIGN KEY partidobidireccional_ibfk_2');
        $this->addSql('ALTER TABLE partidobidireccional CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE local local INT DEFAULT NULL, CHANGE visitante visitante INT DEFAULT NULL');
        $this->addSql('DROP INDEX local ON partidobidireccional');
        $this->addSql('CREATE INDEX IDX_B84FAAFA8BD688E8 ON partidobidireccional (local)');
        $this->addSql('DROP INDEX visitante ON partidobidireccional');
        $this->addSql('CREATE INDEX IDX_B84FAAFAE3659823 ON partidobidireccional (visitante)');
        $this->addSql('ALTER TABLE partidobidireccional ADD CONSTRAINT partidobidireccional_ibfk_1 FOREIGN KEY (local) REFERENCES equipobidireccional (id)');
        $this->addSql('ALTER TABLE partidobidireccional ADD CONSTRAINT partidobidireccional_ibfk_2 FOREIGN KEY (visitante) REFERENCES equipobidireccional (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipo DROP INDEX UNIQ_C49C530B97B7E846, ADD INDEX equipo_presidente_id_fk (presidente_id)');
        $this->addSql('ALTER TABLE equipo CHANGE liga_id liga_id INT NOT NULL, CHANGE presidente_id presidente_id INT DEFAULT 0 NOT NULL, CHANGE nombre nombre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE socios socios VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ciudad ciudad VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE equipobidireccional CHANGE nombre nombre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE socios socios VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ciudad ciudad VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE jugador CHANGE nombre nombre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE apellidos apellidos VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE jugadorbidireccional CHANGE nombre nombre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE apellidos apellidos VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE liga CHANGE pais pais VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nombre nombre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE division division VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE partido DROP INDEX UNIQ_4E79750B8BD688E8, ADD INDEX local (local)');
        $this->addSql('ALTER TABLE partido DROP INDEX UNIQ_4E79750BE3659823, ADD INDEX visitante (visitante)');
        $this->addSql('ALTER TABLE partido CHANGE local local INT NOT NULL, CHANGE visitante visitante INT NOT NULL, CHANGE fecha fecha VARCHAR(255) NOT NULL COLLATE `utf8mb4_general_ci`');
        $this->addSql('ALTER TABLE partidobidireccional DROP FOREIGN KEY FK_B84FAAFA8BD688E8');
        $this->addSql('ALTER TABLE partidobidireccional DROP FOREIGN KEY FK_B84FAAFAE3659823');
        $this->addSql('ALTER TABLE partidobidireccional CHANGE id id INT NOT NULL, CHANGE local local INT NOT NULL, CHANGE visitante visitante INT NOT NULL, CHANGE fecha fecha VARCHAR(255) NOT NULL COLLATE `utf8mb4_general_ci`');
        $this->addSql('DROP INDEX idx_b84faafa8bd688e8 ON partidobidireccional');
        $this->addSql('CREATE INDEX local ON partidobidireccional (local)');
        $this->addSql('DROP INDEX idx_b84faafae3659823 ON partidobidireccional');
        $this->addSql('CREATE INDEX visitante ON partidobidireccional (visitante)');
        $this->addSql('ALTER TABLE partidobidireccional ADD CONSTRAINT FK_B84FAAFA8BD688E8 FOREIGN KEY (local) REFERENCES equipobidireccional (id)');
        $this->addSql('ALTER TABLE partidobidireccional ADD CONSTRAINT FK_B84FAAFAE3659823 FOREIGN KEY (visitante) REFERENCES equipobidireccional (id)');
        $this->addSql('ALTER TABLE presidente CHANGE nombre Nombre VARCHAR(255) NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE apellidos Apellidos VARCHAR(255) NOT NULL COLLATE `utf8mb4_general_ci`');
    }
}
