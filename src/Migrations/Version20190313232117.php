<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190313232117 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE dotlab_checkout (id INT AUTO_INCREMENT NOT NULL, pricing_rules VARCHAR(255) NOT NULL, INDEX checkout_idx (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE checkout_products (checkout_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_9A9FF826146D8724 (checkout_id), INDEX IDX_9A9FF8264584665A (product_id), PRIMARY KEY(checkout_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dotlab_product (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(3) NOT NULL, product_name VARCHAR(255) NOT NULL, product_price DOUBLE PRECISION NOT NULL, INDEX product_idx (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE checkout_products ADD CONSTRAINT FK_9A9FF826146D8724 FOREIGN KEY (checkout_id) REFERENCES dotlab_checkout (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE checkout_products ADD CONSTRAINT FK_9A9FF8264584665A FOREIGN KEY (product_id) REFERENCES dotlab_product (id) ON DELETE CASCADE');
        $this->addSql('INSERT INTO `dotlab_product` (`id`, `code`, `product_name`, `product_price`) VALUES (1, \'PG1\', \'Pomegranates\', 10.57)');
        $this->addSql('INSERT INTO `dotlab_product` (`id`, `code`, `product_name`, `product_price`) VALUES (2, \'LE1\', \'Lemons\', 1)');
        $this->addSql('INSERT INTO `dotlab_product` (`id`, `code`, `product_name`, `product_price`) VALUES (3, \'BN1\', \'Bananas\', 2.43)');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE checkout_products DROP FOREIGN KEY FK_9A9FF826146D8724');
        $this->addSql('ALTER TABLE checkout_products DROP FOREIGN KEY FK_9A9FF8264584665A');
        $this->addSql('DROP TABLE dotlab_checkout');
        $this->addSql('DROP TABLE checkout_products');
        $this->addSql('DROP TABLE dotlab_product');
    }
}
