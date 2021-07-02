<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210611091804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B156BBCF0CB');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B156BBCF0CB FOREIGN KEY (job_candidat_id) REFERENCES job_category (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidats DROP FOREIGN KEY FK_3C663B156BBCF0CB');
        $this->addSql('ALTER TABLE candidats ADD CONSTRAINT FK_3C663B156BBCF0CB FOREIGN KEY (job_candidat_id) REFERENCES job_category (id)');
    }
}
