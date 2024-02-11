<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240211095810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create the initial stock management system tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<SQL
            CREATE TABLE IF NOT EXISTS products (
                id SERIAL PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                description TEXT,
                -- Assurez-vous que ces champs correspondent à ceux de votre CMS si déjà existants
                created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
            );
        SQL);
        $this->addSql(<<<SQL
            CREATE TABLE IF NOT EXISTS stock_items (
                id SERIAL PRIMARY KEY,
                product_id INT NOT NULL,
                quantity INT NOT NULL CHECK (quantity >= 0), -- Empêche les quantités négatives
                location VARCHAR(255), -- Optionnel, si vous suivez les emplacements de stock
                created_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (product_id) REFERENCES products(id)
            );
        SQL);
        $this->addSql(<<<SQL
            CREATE TABLE IF NOT EXISTS stock_movements (
                id SERIAL PRIMARY KEY,
                stock_item_id INT NOT NULL,
                type VARCHAR(50), -- Par exemple, "IN" pour entrée, "OUT" pour sortie
                quantity INT NOT NULL,
                reason TEXT, -- Optionnel, par exemple "commande", "retour", "réapprovisionnement"
                movement_date TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (stock_item_id) REFERENCES stock_items(id)
            );
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS stock_movements');
        $this->addSql('DROP TABLE IF EXISTS stock_items');
        $this->addSql('DROP TABLE IF EXISTS products');
    }
}
