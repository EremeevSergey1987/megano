<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230607084342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, parent_id INT NOT NULL, category_id INT DEFAULT NULL, childre_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(200) NOT NULL, text VARCHAR(255) NOT NULL, published_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_64C19C1989D9B62 (slug), INDEX IDX_64C19C112469DE2 (category_id), INDEX IDX_64C19C19B50C8 (childre_id_id), INDEX IDX_64C19C1727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(200) NOT NULL, description VARCHAR(255) NOT NULL, published_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', img VARCHAR(255) NOT NULL, price INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_B3BA5A5A989D9B62 (slug), INDEX IDX_B3BA5A5A12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C19B50C8 FOREIGN KEY (childre_id_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C112469DE2');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C19B50C8');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A12469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE products');
    }
}
