<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200604131632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE card_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card_type_card (card_type_id INT NOT NULL, card_id INT NOT NULL, INDEX IDX_B513BE8F925606E5 (card_type_id), INDEX IDX_B513BE8F4ACC9A20 (card_id), PRIMARY KEY(card_type_id, card_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE card_type_card ADD CONSTRAINT FK_B513BE8F925606E5 FOREIGN KEY (card_type_id) REFERENCES card_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE card_type_card ADD CONSTRAINT FK_B513BE8F4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE card DROP type');
        $this->addSql('INSERT INTO card_type (name) VALUES ("Normal"),("Effect"),("Link"),("Tuner"),("Fusion"),("Flip"),("Spell Card"),("Trap Card"),("Pendulum"),("Ritual"),("Token"),("Synchro"),("XYZ"),("Toon"),("Union"),("Spirit"),("Gemini"),("Monster")');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card_type_card DROP FOREIGN KEY FK_B513BE8F925606E5');
        $this->addSql('DROP TABLE card_type');
        $this->addSql('DROP TABLE card_type_card');
        $this->addSql('ALTER TABLE card ADD type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
