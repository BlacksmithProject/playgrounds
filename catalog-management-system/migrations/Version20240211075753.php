<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240211075753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Fixtures for categories and products table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<SQL
            INSERT INTO categories (name, description) VALUES
            ('Fruits et Légumes', 'Frais du jour'),
            ('Boissons', 'Eaux, jus et sodas'),
            ('Boulangerie', 'Pains et pâtisseries'),
            ('Épicerie', 'Conserves, pâtes, riz et autres'),
            ('Produits Laitiers', 'Lait, fromage, beurre, etc.'),
            ('Viandes et Poissons', 'Viandes fraîches et poissons'),
            ('Snacks', 'Chips, biscuits et confiseries'),
            ('Boissons Alcoolisées', 'Vins, bières et spiritueux'),
            ('Surgelés', 'Plats et légumes surgelés'),
            ('Hygiène et Beauté', 'Produits de soin et de beauté');
        SQL);
        $this->addSql(<<<SQL
            -- Insertion de deux produits par catégorie
            -- Fruits et Légumes
            INSERT INTO products (name, description, price, category_id) VALUES 
            ('Pomme Golden', 'Pommes croquantes et juteuses, parfaites pour une collation.', 0.50, (SELECT id FROM categories WHERE name='Fruits et Légumes')),
            ('Carotte', 'Riches en bêta-carotène, idéales pour les salades ou à cuire.', 0.30, (SELECT id FROM categories WHERE name='Fruits et Légumes')),
            
            -- Boissons
            ('Eau Minérale Naturelle', 'Eau pure et rafraîchissante, source de vitalité.', 0.99, (SELECT id FROM categories WHERE name='Boissons')),
            ('Jus d''orange', 'Jus pressé 100% orange, sans sucre ajouté.', 2.50, (SELECT id FROM categories WHERE name='Boissons')),
            
            -- Boulangerie
            ('Baguette tradition', 'Croustillante et dorée, faite avec du levain naturel.', 1.00, (SELECT id FROM categories WHERE name='Boulangerie')),
            ('Croissant', 'Beurré et léger, le plaisir du petit déjeuner français.', 1.20, (SELECT id FROM categories WHERE name='Boulangerie')),

            -- Épicerie
            ('Pâtes Spaghetti', 'Pâtes italiennes classiques pour tous vos plats favoris.', 1.50, (SELECT id FROM categories WHERE name='Épicerie')),
            ('Riz Basmati', 'Riz parfumé long grain, idéal pour les plats asiatiques.', 2.00, (SELECT id FROM categories WHERE name='Épicerie')),
            
            -- Produits Laitiers
            ('Lait Entier', 'Lait frais et riche en goût, source de calcium.', 0.90, (SELECT id FROM categories WHERE name='Produits Laitiers')),
            ('Yaourt Nature', 'Yaourt onctueux sans sucre ajouté, parfait pour votre santé.', 0.60, (SELECT id FROM categories WHERE name='Produits Laitiers')),
            
            -- Viandes et Poissons
            ('Filet de Poulet', 'Poulet tendre et juteux, élevé en plein air.', 3.50, (SELECT id FROM categories WHERE name='Viandes et Poissons')),
            ('Saumon Frais', 'Filets de saumon riches en oméga-3, pêche durable.', 5.00, (SELECT id FROM categories WHERE name='Viandes et Poissons')),
            
            -- Snacks
            ('Chips de Pomme de Terre', 'Croustillantes et savoureuses, avec une pointe de sel.', 2.00, (SELECT id FROM categories WHERE name='Snacks')),
            ('Barre de Chocolat', 'Chocolat noir intense pour une pause gourmande.', 1.50, (SELECT id FROM categories WHERE name='Snacks')),
            
            -- Boissons Alcoolisées
            ('Vin Rouge Bordeaux', 'Un classique élégant aux notes de fruits mûrs.', 10.00, (SELECT id FROM categories WHERE name='Boissons Alcoolisées')),
            ('Bière Blonde', 'Bière légère et rafraîchissante, parfaite pour l''apéritif.', 1.80, (SELECT id FROM categories WHERE name='Boissons Alcoolisées')),
            
            -- Surgelés
            ('Poisson Pané', 'Filets de poisson croustillants, prêts à cuire.', 4.00, (SELECT id FROM categories WHERE name='Surgelés')),
            ('Légumes pour Wok', 'Mélange de légumes surgelés, idéal pour un wok rapide et sain.', 3.00, (SELECT id FROM categories WHERE name='Surgelés')),
            
            -- Hygiène et Beauté
            ('Shampooing Doux', 'Pour des cheveux brillants et pleins de vie.', 4.50, (SELECT id FROM categories WHERE name='Hygiène et Beauté')),
            ('Dentifrice Menthe Fraîche', 'Protection complète et haleine fraîche.', 2.50, (SELECT id FROM categories WHERE name='Hygiène et Beauté'));
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM products');
        $this->addSql('DELETE FROM categories');
    }
}
