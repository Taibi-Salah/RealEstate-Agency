<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240627085705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // SQL statements
        $this->addSql('ALTER TABLE property ADD some_column INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // SQL statements to revert the migration
        $this->addSql('ALTER TABLE property DROP some_column');
    }
}


