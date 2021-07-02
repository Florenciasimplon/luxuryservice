<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210610124019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info_admin_clients DROP FOREIGN KEY FK_8C6B476119EB6921');
        $this->addSql('ALTER TABLE info_admin_clients ADD CONSTRAINT FK_8C6B476119EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info_admin_clients DROP FOREIGN KEY FK_8C6B476119EB6921');
        $this->addSql('ALTER TABLE info_admin_clients ADD CONSTRAINT FK_8C6B476119EB6921 FOREIGN KEY (client_id) REFERENCES clients (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
