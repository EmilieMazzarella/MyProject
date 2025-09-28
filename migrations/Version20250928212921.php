<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250928212921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur_post_enregistre (utilisateur_id INT NOT NULL, post_id INT NOT NULL, INDEX IDX_930B00B7FB88E14F (utilisateur_id), INDEX IDX_930B00B74B89032C (post_id), PRIMARY KEY(utilisateur_id, post_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE utilisateur_post_enregistre ADD CONSTRAINT FK_930B00B7FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_post_enregistre ADD CONSTRAINT FK_930B00B74B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur_post_enregistre DROP FOREIGN KEY FK_930B00B7FB88E14F');
        $this->addSql('ALTER TABLE utilisateur_post_enregistre DROP FOREIGN KEY FK_930B00B74B89032C');
        $this->addSql('DROP TABLE utilisateur_post_enregistre');
    }
}
