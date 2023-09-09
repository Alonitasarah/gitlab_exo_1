<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230907225910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant ADD module_souhaite VARCHAR(255) DEFAULT NULL, ADD motif_inscription VARCHAR(255) DEFAULT NULL, DROP module_choisit, DROP motif, CHANGE prenoms prenom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant ADD module_choisit VARCHAR(255) DEFAULT NULL, ADD motif VARCHAR(255) DEFAULT NULL, DROP module_souhaite, DROP motif_inscription, CHANGE prenom prenoms VARCHAR(255) NOT NULL');
    }
}
