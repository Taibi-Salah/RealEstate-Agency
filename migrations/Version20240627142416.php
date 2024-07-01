<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240627142416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add slug field to Property entity';
    }

    public function up(Schema $schema): void
    {
        // This method is called when the migration is executed.
        $schemaManager = $this->connection->getSchemaManager();
        $columns = $schemaManager->listTableColumns('property');

        if (!isset($columns['slug'])) {
            $this->addSql('ALTER TABLE property ADD slug VARCHAR(255) NOT NULL');
        }

        $indexes = $schemaManager->listTableIndexes('property');
        $uniqueIndexExists = false;
        foreach ($indexes as $index) {
            if ($index->isUnique() && $index->getColumns() === ['slug']) {
                $uniqueIndexExists = true;
                break;
            }
        }

        if (!$uniqueIndexExists) {
            $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDE989D9B62 ON property (slug)');
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE property DROP COLUMN slug');
    }
}


