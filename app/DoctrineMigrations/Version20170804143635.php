<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170804143635 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13B4584665A');
        $this->addSql('DROP INDEX IDX_6117D13B4584665A ON purchase');
        $this->addSql('ALTER TABLE purchase CHANGE product_id product INT DEFAULT NULL');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13BD34A04AD FOREIGN KEY (product) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_6117D13BD34A04AD ON purchase (product)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13BD34A04AD');
        $this->addSql('DROP INDEX IDX_6117D13BD34A04AD ON purchase');
        $this->addSql('ALTER TABLE purchase CHANGE product product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_6117D13B4584665A ON purchase (product_id)');
    }
}
