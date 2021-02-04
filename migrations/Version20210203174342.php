<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203174342 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project ADD skills_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE7FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE7FF61858 ON project (skills_id)');
        $this->addSql('ALTER TABLE skills DROP FOREIGN KEY FK_D5311670166D1F9C');
        $this->addSql('DROP INDEX IDX_D5311670166D1F9C ON skills');
        $this->addSql('ALTER TABLE skills DROP project_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE7FF61858');
        $this->addSql('DROP INDEX IDX_2FB3D0EE7FF61858 ON project');
        $this->addSql('ALTER TABLE project DROP skills_id');
        $this->addSql('ALTER TABLE skills ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE skills ADD CONSTRAINT FK_D5311670166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D5311670166D1F9C ON skills (project_id)');
    }
}
