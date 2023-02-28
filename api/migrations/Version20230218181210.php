<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230218181210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie_movie_category (movie_id INT NOT NULL, movie_category_id INT NOT NULL, INDEX IDX_F9DC16648F93B6FC (movie_id), INDEX IDX_F9DC16643DC01115 (movie_category_id), PRIMARY KEY(movie_id, movie_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie_movie_category ADD CONSTRAINT FK_F9DC16648F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_movie_category ADD CONSTRAINT FK_F9DC16643DC01115 FOREIGN KEY (movie_category_id) REFERENCES movie_category (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie_movie_category DROP FOREIGN KEY FK_F9DC16648F93B6FC');
        $this->addSql('ALTER TABLE movie_movie_category DROP FOREIGN KEY FK_F9DC16643DC01115');
        $this->addSql('DROP TABLE movie_movie_category');
    }
}
