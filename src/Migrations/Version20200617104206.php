<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200617104206 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3CE42AF5C');
        $this->addSql('DROP INDEX IDX_161498D3CE42AF5C ON card');
        $this->addSql('ALTER TABLE card DROP deck_card_id');
        $this->addSql('ALTER TABLE deck DROP FOREIGN KEY FK_4FAC3637CE42AF5C');
        $this->addSql('DROP INDEX IDX_4FAC3637CE42AF5C ON deck');
        $this->addSql('ALTER TABLE deck DROP deck_card_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card ADD deck_card_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3CE42AF5C FOREIGN KEY (deck_card_id) REFERENCES deck_card (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_161498D3CE42AF5C ON card (deck_card_id)');
        $this->addSql('ALTER TABLE deck ADD deck_card_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE deck ADD CONSTRAINT FK_4FAC3637CE42AF5C FOREIGN KEY (deck_card_id) REFERENCES deck_card (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4FAC3637CE42AF5C ON deck (deck_card_id)');
    }
}
