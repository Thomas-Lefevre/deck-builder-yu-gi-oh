<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200527093318 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE card (id INT AUTO_INCREMENT NOT NULL, img VARCHAR(255) NOT NULL, img_minia VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, attribute VARCHAR(255) NOT NULL, race VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, archetype VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, set_name VARCHAR(255) NOT NULL, set_code VARCHAR(255) NOT NULL, set_rarity VARCHAR(255) NOT NULL, banlist_info VARCHAR(255) NOT NULL, atk_def_lvl LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', link_markers LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', link_val INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card_deck (card_id INT NOT NULL, deck_id INT NOT NULL, INDEX IDX_A39F34954ACC9A20 (card_id), INDEX IDX_A39F3495111948DC (deck_id), PRIMARY KEY(card_id, deck_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deck (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, format VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, note INT NOT NULL, prix DOUBLE PRECISION NOT NULL, type VARCHAR(255) NOT NULL, date_post DATE NOT NULL, img VARCHAR(255) NOT NULL, auteur VARCHAR(255) NOT NULL, INDEX IDX_4FAC363779F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE card_deck ADD CONSTRAINT FK_A39F34954ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE card_deck ADD CONSTRAINT FK_A39F3495111948DC FOREIGN KEY (deck_id) REFERENCES deck (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE deck ADD CONSTRAINT FK_4FAC363779F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD avatar VARCHAR(255) NOT NULL, CHANGE username username VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card_deck DROP FOREIGN KEY FK_A39F34954ACC9A20');
        $this->addSql('ALTER TABLE card_deck DROP FOREIGN KEY FK_A39F3495111948DC');
        $this->addSql('DROP TABLE card');
        $this->addSql('DROP TABLE card_deck');
        $this->addSql('DROP TABLE deck');
        $this->addSql('ALTER TABLE user DROP avatar, CHANGE username username VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
