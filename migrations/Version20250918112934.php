<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250918112934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE remarque ADD article_id INT NOT NULL');
        $this->addSql('ALTER TABLE remarque ADD CONSTRAINT FK_B9741AAB7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_B9741AAB7294869C ON remarque (article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE remarque DROP FOREIGN KEY FK_B9741AAB7294869C');
        $this->addSql('DROP INDEX IDX_B9741AAB7294869C ON remarque');
        $this->addSql('ALTER TABLE remarque DROP article_id');
    }
}
