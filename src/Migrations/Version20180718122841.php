<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180718122841 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE group_team DROP FOREIGN KEY FK_EDBAFD6FFE54D947');
        $this->addSql('CREATE TABLE groups_team (id INT AUTO_INCREMENT NOT NULL, group_id INT DEFAULT NULL, team_id INT DEFAULT NULL, INDEX IDX_B987382EFE54D947 (group_id), INDEX IDX_B987382E296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groups (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, competition_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE groups_team ADD CONSTRAINT FK_B987382EFE54D947 FOREIGN KEY (group_id) REFERENCES groups (id)');
        $this->addSql('ALTER TABLE groups_team ADD CONSTRAINT FK_B987382E296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE group_team');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE groups_team DROP FOREIGN KEY FK_B987382EFE54D947');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, type VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, competition_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_team (id INT AUTO_INCREMENT NOT NULL, group_id INT DEFAULT NULL, team_id INT DEFAULT NULL, INDEX IDX_EDBAFD6FFE54D947 (group_id), INDEX IDX_EDBAFD6F296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE group_team ADD CONSTRAINT FK_EDBAFD6F296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE group_team ADD CONSTRAINT FK_EDBAFD6FFE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id)');
        $this->addSql('DROP TABLE groups_team');
        $this->addSql('DROP TABLE groups');
    }
}
