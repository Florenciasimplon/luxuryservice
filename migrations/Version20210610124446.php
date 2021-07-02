<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210610124446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B83481D195');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B83481D195 FOREIGN KEY (job_offer_id) REFERENCES job_offer (id)');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E19EB6921');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E19EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B83481D195');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B83481D195 FOREIGN KEY (job_offer_id) REFERENCES job_offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_offer DROP FOREIGN KEY FK_288A3A4E19EB6921');
        $this->addSql('ALTER TABLE job_offer ADD CONSTRAINT FK_288A3A4E19EB6921 FOREIGN KEY (client_id) REFERENCES clients (id) ON DELETE CASCADE');
    }
}