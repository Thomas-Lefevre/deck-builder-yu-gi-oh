<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200617104731 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE deck_card ADD deck_id INT NOT NULL, ADD card_id INT NOT NULL');
        $this->addSql('ALTER TABLE deck_card ADD CONSTRAINT FK_2AF3DCED111948DC FOREIGN KEY (deck_id) REFERENCES deck (id)');
        $this->addSql('ALTER TABLE deck_card ADD CONSTRAINT FK_2AF3DCED4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id)');
        $this->addSql('CREATE INDEX IDX_2AF3DCED111948DC ON deck_card (deck_id)');
        $this->addSql('CREATE INDEX IDX_2AF3DCED4ACC9A20 ON deck_card (card_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE deck_card DROP FOREIGN KEY FK_2AF3DCED111948DC');
        $this->addSql('ALTER TABLE deck_card DROP FOREIGN KEY FK_2AF3DCED4ACC9A20');
        $this->addSql('DROP INDEX IDX_2AF3DCED111948DC ON deck_card');
        $this->addSql('DROP INDEX IDX_2AF3DCED4ACC9A20 ON deck_card');
        $this->addSql('ALTER TABLE deck_card DROP deck_id, DROP card_id');
    }
}
