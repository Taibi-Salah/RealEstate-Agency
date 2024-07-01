<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240627142108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add slug field to Property entity';
    }

    public function up(Schema $schema): void
    {
        // This method is called when the migration is executed.
        $this->addSql('ALTER TABLE property ADD COLUMN IF NOT EXISTS slug VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX IF NOT EXISTS UNIQ_8BF21CDE989D9B62 ON property (slug)');
    }

    public function down(Schema $schema): void
    {
        // This method is called when the migration is reverted.
        $this->addSql('ALTER TABLE property DROP COLUMN slug');
    }
}




