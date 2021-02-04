<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203180708 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_skills (project_id INT NOT NULL, skills_id INT NOT NULL, INDEX IDX_C295FD3A166D1F9C (project_id), INDEX IDX_C295FD3A7FF61858 (skills_id), PRIMARY KEY(project_id, skills_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_skills ADD CONSTRAINT FK_C295FD3A166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_skills ADD CONSTRAINT FK_C295FD3A7FF61858 FOREIGN KEY (skills_id) REFERENCES skills (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skills DROP FOREIGN KEY FK_D5311670166D1F9C');
        $this->addSql('DROP INDEX IDX_D5311670166D1F9C ON skills');
        $this->addSql('ALTER TABLE skills DROP project_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE project_skills');
        $this->addSql('ALTER TABLE skills ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE skills ADD CONSTRAINT FK_D5311670166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D5311670166D1F9C ON skills (project_id)');
    }
}
