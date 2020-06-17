<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200617094353 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE deck_card (deck_id INT NOT NULL, card_id INT NOT NULL, INDEX IDX_2AF3DCED111948DC (deck_id), INDEX IDX_2AF3DCED4ACC9A20 (card_id), PRIMARY KEY(deck_id, card_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deck_card ADD CONSTRAINT FK_2AF3DCED111948DC FOREIGN KEY (deck_id) REFERENCES deck (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE deck_card ADD CONSTRAINT FK_2AF3DCED4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE card_deck');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE card_deck (card_id INT NOT NULL, deck_id INT NOT NULL, INDEX IDX_A39F3495111948DC (deck_id), INDEX IDX_A39F34954ACC9A20 (card_id), PRIMARY KEY(card_id, deck_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE card_deck ADD CONSTRAINT FK_A39F3495111948DC FOREIGN KEY (deck_id) REFERENCES deck (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE card_deck ADD CONSTRAINT FK_A39F34954ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE deck_card');
    }
}
