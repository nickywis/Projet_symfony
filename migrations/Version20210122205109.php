<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210122205109 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE films_acteurs (films_id INT NOT NULL, acteurs_id INT NOT NULL, INDEX IDX_A526A0F939610EE (films_id), INDEX IDX_A526A0F71A27AFC (acteurs_id), PRIMARY KEY(films_id, acteurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE films_acteurs ADD CONSTRAINT FK_A526A0F939610EE FOREIGN KEY (films_id) REFERENCES films (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE films_acteurs ADD CONSTRAINT FK_A526A0F71A27AFC FOREIGN KEY (acteurs_id) REFERENCES acteurs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acteurs DROP FOREIGN KEY FK_B85835AC939610EE');
        $this->addSql('DROP INDEX IDX_B85835AC939610EE ON acteurs');
        $this->addSql('ALTER TABLE acteurs DROP films_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE films_acteurs');
        $this->addSql('ALTER TABLE acteurs ADD films_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE acteurs ADD CONSTRAINT FK_B85835AC939610EE FOREIGN KEY (films_id) REFERENCES films (id)');
        $this->addSql('CREATE INDEX IDX_B85835AC939610EE ON acteurs (films_id)');
    }
}
