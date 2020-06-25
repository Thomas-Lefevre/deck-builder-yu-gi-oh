<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200625141522 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE deck DROP FOREIGN KEY FK_4FAC363779F37AE5');
        $this->addSql('DROP INDEX IDX_4FAC363779F37AE5 ON deck');
        $this->addSql('ALTER TABLE deck CHANGE id_user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE deck ADD CONSTRAINT FK_4FAC3637A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4FAC3637A76ED395 ON deck (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE deck DROP FOREIGN KEY FK_4FAC3637A76ED395');
        $this->addSql('DROP INDEX IDX_4FAC3637A76ED395 ON deck');
        $this->addSql('ALTER TABLE deck CHANGE user_id id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE deck ADD CONSTRAINT FK_4FAC363779F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4FAC363779F37AE5 ON deck (id_user_id)');
    }
}
