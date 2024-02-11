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
        if ('prod' === $_ENV['APP_ENV']) {
            return;
        }
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
            INSERT INTO products (id, name, description, price, category_id) VALUES 
            ('fc5f3527-c234-4a63-9519-9e63cb517740', 'Pomme Golden', 'Pommes croquantes et juteuses, parfaites pour une collation.', 0.50, (SELECT id FROM categories WHERE name='Fruits et Légumes')),
            ('6270d51b-1fd4-4e74-8371-ce4c03981dcc', 'Carotte', 'Riches en bêta-carotène, idéales pour les salades ou à cuire.', 0.30, (SELECT id FROM categories WHERE name='Fruits et Légumes')),
            
            -- Boissons
            ('cab3759a-b63c-47b3-96d1-44dd51422625', 'Eau Minérale Naturelle', 'Eau pure et rafraîchissante, source de vitalité.', 0.99, (SELECT id FROM categories WHERE name='Boissons')),
            ('690620c9-9974-4ed6-8927-c5d3fa4e345a', 'Jus d''orange', 'Jus pressé 100% orange, sans sucre ajouté.', 2.50, (SELECT id FROM categories WHERE name='Boissons')),
            
            -- Boulangerie
            ('5291f1c4-3745-4e47-8a3f-fbd4fe1669e3', 'Baguette tradition', 'Croustillante et dorée, faite avec du levain naturel.', 1.00, (SELECT id FROM categories WHERE name='Boulangerie')),
            ('41b55667-4a48-4eec-8b12-ca48b22fdeef', 'Croissant', 'Beurré et léger, le plaisir du petit déjeuner français.', 1.20, (SELECT id FROM categories WHERE name='Boulangerie')),

            -- Épicerie
            ('11c9091d-3c72-468b-a453-5c700243d8d3', 'Pâtes Spaghetti', 'Pâtes italiennes classiques pour tous vos plats favoris.', 1.50, (SELECT id FROM categories WHERE name='Épicerie')),
            ('0b3a6023-eef8-4535-bfcb-d02739717e7a', 'Riz Basmati', 'Riz parfumé long grain, idéal pour les plats asiatiques.', 2.00, (SELECT id FROM categories WHERE name='Épicerie')),
            
            -- Produits Laitiers
            ('30b9d4be-78ec-471b-a734-b395eeaf40d6', 'Lait Entier', 'Lait frais et riche en goût, source de calcium.', 0.90, (SELECT id FROM categories WHERE name='Produits Laitiers')),
            ('0236d567-b811-45dc-83ef-23cc3d1a5d51', 'Yaourt Nature', 'Yaourt onctueux sans sucre ajouté, parfait pour votre santé.', 0.60, (SELECT id FROM categories WHERE name='Produits Laitiers')),
            
            -- Viandes et Poissons
            ('d57fe254-3d74-4572-8362-4945a512c2d8', 'Filet de Poulet', 'Poulet tendre et juteux, élevé en plein air.', 3.50, (SELECT id FROM categories WHERE name='Viandes et Poissons')),
            ('128c0692-f36e-495e-8ee1-7f936f3a6165', 'Saumon Frais', 'Filets de saumon riches en oméga-3, pêche durable.', 5.00, (SELECT id FROM categories WHERE name='Viandes et Poissons')),
            
            -- Snacks
            ('f7987479-cb8f-450b-b668-3726389e0637', 'Chips de Pomme de Terre', 'Croustillantes et savoureuses, avec une pointe de sel.', 2.00, (SELECT id FROM categories WHERE name='Snacks')),
            ('231af854-6dbf-4bfc-b937-c8d8f95f6e0d', 'Barre de Chocolat', 'Chocolat noir intense pour une pause gourmande.', 1.50, (SELECT id FROM categories WHERE name='Snacks')),
            
            -- Boissons Alcoolisées
            ('268cd53f-166c-41cc-b935-2fdbdb37eb26', 'Vin Rouge Bordeaux', 'Un classique élégant aux notes de fruits mûrs.', 10.00, (SELECT id FROM categories WHERE name='Boissons Alcoolisées')),
            ('a25e28da-af22-4c19-b605-f540e90784c2', 'Bière Blonde', 'Bière légère et rafraîchissante, parfaite pour l''apéritif.', 1.80, (SELECT id FROM categories WHERE name='Boissons Alcoolisées')),
            
            -- Surgelés
            ('28fc98b3-a654-4f04-9f6a-efe6ada6fc53', 'Poisson Pané', 'Filets de poisson croustillants, prêts à cuire.', 4.00, (SELECT id FROM categories WHERE name='Surgelés')),
            ('a3c9ceb5-0721-4464-ab33-8944d2f679d1', 'Légumes pour Wok', 'Mélange de légumes surgelés, idéal pour un wok rapide et sain.', 3.00, (SELECT id FROM categories WHERE name='Surgelés')),
            
            -- Hygiène et Beauté
            ('e43f8898-a228-4f7a-a6e3-09237a0ebcb3', 'Shampooing Doux', 'Pour des cheveux brillants et pleins de vie.', 4.50, (SELECT id FROM categories WHERE name='Hygiène et Beauté')),
            ('4fc0a425-32e9-40c4-bbd8-0a808f6e1856', 'Dentifrice Menthe Fraîche', 'Protection complète et haleine fraîche.', 2.50, (SELECT id FROM categories WHERE name='Hygiène et Beauté'));
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM products');
        $this->addSql('DELETE FROM categories');
    }
}
