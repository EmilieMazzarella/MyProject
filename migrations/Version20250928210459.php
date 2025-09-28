<?php

// declare(strict_types=1);

// namespace DoctrineMigrations;

// use Doctrine\DBAL\Schema\Schema;
// use Doctrine\Migrations\AbstractMigration;

// /**
//  * Auto-generated Migration: Please modify to your needs!
//  */
// final class Version20250928210459 extends AbstractMigration
// {
//     public function getDescription(): string
//     {
//         return '';
//     }

//     public function up(Schema $schema): void
//     {
//         // this up() migration is auto-generated, please modify it to your needs
//         $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, sujet_id INT NOT NULL, titre VARCHAR(50) NOT NULL, introduction VARCHAR(300) NOT NULL, date DATETIME NOT NULL, texte LONGTEXT NOT NULL, INDEX IDX_23A0E667C4D497E (sujet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, texte VARCHAR(750) NOT NULL, date DATETIME NOT NULL, INDEX IDX_9474526C4B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE hashtag (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, sujet_id INT NOT NULL, titre VARCHAR(50) DEFAULT NULL, texte LONGTEXT NOT NULL, date DATETIME NOT NULL, INDEX IDX_5A8A6C8D7C4D497E (sujet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE remarque (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, texte VARCHAR(1000) NOT NULL, INDEX IDX_B9741AAB7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE sujet (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE utilisateur_post_invalide (utilisateur_id INT NOT NULL, post_id INT NOT NULL, INDEX IDX_99A9B823FB88E14F (utilisateur_id), INDEX IDX_99A9B8234B89032C (post_id), PRIMARY KEY(utilisateur_id, post_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE utilisateur_post_valide (utilisateur_id INT NOT NULL, post_id INT NOT NULL, INDEX IDX_6907B14FB88E14F (utilisateur_id), INDEX IDX_6907B144B89032C (post_id), PRIMARY KEY(utilisateur_id, post_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE utilisateur_post_redige (utilisateur_id INT NOT NULL, post_id INT NOT NULL, INDEX IDX_8618E4EEFB88E14F (utilisateur_id), INDEX IDX_8618E4EE4B89032C (post_id), PRIMARY KEY(utilisateur_id, post_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//         $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E667C4D497E FOREIGN KEY (sujet_id) REFERENCES sujet (id)');
//         $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
//         $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D7C4D497E FOREIGN KEY (sujet_id) REFERENCES sujet (id)');
//         $this->addSql('ALTER TABLE remarque ADD CONSTRAINT FK_B9741AAB7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
//         $this->addSql('ALTER TABLE utilisateur_post_invalide ADD CONSTRAINT FK_99A9B823FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
//         $this->addSql('ALTER TABLE utilisateur_post_invalide ADD CONSTRAINT FK_99A9B8234B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
//         $this->addSql('ALTER TABLE utilisateur_post_valide ADD CONSTRAINT FK_6907B14FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
//         $this->addSql('ALTER TABLE utilisateur_post_valide ADD CONSTRAINT FK_6907B144B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
//         $this->addSql('ALTER TABLE utilisateur_post_redige ADD CONSTRAINT FK_8618E4EEFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
//         $this->addSql('ALTER TABLE utilisateur_post_redige ADD CONSTRAINT FK_8618E4EE4B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
//     }

//     public function down(Schema $schema): void
//     {
//         // this down() migration is auto-generated, please modify it to your needs
//         $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E667C4D497E');
//         $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4B89032C');
//         $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D7C4D497E');
//         $this->addSql('ALTER TABLE remarque DROP FOREIGN KEY FK_B9741AAB7294869C');
//         $this->addSql('ALTER TABLE utilisateur_post_invalide DROP FOREIGN KEY FK_99A9B823FB88E14F');
//         $this->addSql('ALTER TABLE utilisateur_post_invalide DROP FOREIGN KEY FK_99A9B8234B89032C');
//         $this->addSql('ALTER TABLE utilisateur_post_valide DROP FOREIGN KEY FK_6907B14FB88E14F');
//         $this->addSql('ALTER TABLE utilisateur_post_valide DROP FOREIGN KEY FK_6907B144B89032C');
//         $this->addSql('ALTER TABLE utilisateur_post_redige DROP FOREIGN KEY FK_8618E4EEFB88E14F');
//         $this->addSql('ALTER TABLE utilisateur_post_redige DROP FOREIGN KEY FK_8618E4EE4B89032C');
//         $this->addSql('DROP TABLE article');
//         $this->addSql('DROP TABLE comment');
//         $this->addSql('DROP TABLE hashtag');
//         $this->addSql('DROP TABLE post');
//         $this->addSql('DROP TABLE remarque');
//         $this->addSql('DROP TABLE sujet');
//         $this->addSql('DROP TABLE utilisateur');
//         $this->addSql('DROP TABLE utilisateur_post_invalide');
//         $this->addSql('DROP TABLE utilisateur_post_valide');
//         $this->addSql('DROP TABLE utilisateur_post_redige');
//         $this->addSql('DROP TABLE messenger_messages');
//     }
// }
