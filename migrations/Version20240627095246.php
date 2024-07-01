<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240627095820 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property ADD surface INT NOT NULL');
        $this->addSql('ALTER TABLE property ADD rooms INT NOT NULL');
        $this->addSql('ALTER TABLE property ADD bedrooms INT NOT NULL');
        $this->addSql('ALTER TABLE property ADD floor INT NOT NULL');
        $this->addSql('ALTER TABLE property ADD city VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE property ADD address VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE property ADD postal_code VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE property ADD sold TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE property ADD parking INT NOT NULL');
        $this->addSql('ALTER TABLE property ADD status INT NOT NULL');
        $this->addSql('ALTER TABLE property ADD type INT NOT NULL');
        $this->addSql('ALTER TABLE property ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE property ADD updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE property ADD price INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property DROP surface');
        $this->addSql('ALTER TABLE property DROP rooms');
        $this->addSql('ALTER TABLE property DROP bedrooms');
        $this->addSql('ALTER TABLE property DROP floor');
        $this->addSql('ALTER TABLE property DROP city');
        $this->addSql('ALTER TABLE property DROP address');
        $this->addSql('ALTER TABLE property DROP postal_code');
        $this->addSql('ALTER TABLE property DROP sold');
        $this->addSql('ALTER TABLE property DROP parking');
        $this->addSql('ALTER TABLE property DROP status');
        $this->addSql('ALTER TABLE property DROP type');
        $this->addSql('ALTER TABLE property DROP created_at');
        $this->addSql('ALTER TABLE property DROP updated_at');
        $this->addSql('ALTER TABLE property DROP price');
    }
}

