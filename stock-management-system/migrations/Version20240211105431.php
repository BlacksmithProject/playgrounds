<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240211105431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert initial stock items data.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(<<<SQL
            INSERT INTO stock_items (product_id, quantity, location) VALUES
            ('fc5f3527-c234-4a63-9519-9e63cb517740', 150, 'Entrepôt Central'),
            ('6270d51b-1fd4-4e74-8371-ce4c03981dcc', 200, 'Entrepôt Central'),
            ('cab3759a-b63c-47b3-96d1-44dd51422625', 300, 'Entrepôt Central'),
            ('690620c9-9974-4ed6-8927-c5d3fa4e345a', 120, 'Entrepôt Central'),
            ('5291f1c4-3745-4e47-8a3f-fbd4fe1669e3', 80, 'Entrepôt Central'),
            ('41b55667-4a48-4eec-8b12-ca48b22fdeef', 90, 'Entrepôt Central'),
            ('11c9091d-3c72-468b-a453-5c700243d8d3', 250, 'Entrepôt Central'),
            ('0b3a6023-eef8-4535-bfcb-d02739717e7a', 220, 'Entrepôt Central'),
            ('30b9d4be-78ec-471b-a734-b395eeaf40d6', 180, 'Entrepôt Central'),
            ('0236d567-b811-45dc-83ef-23cc3d1a5d51', 160, 'Entrepôt Central'),
            ('d57fe254-3d74-4572-8362-4945a512c2d8', 100, 'Entrepôt Central'),
            ('128c0692-f36e-495e-8ee1-7f936f3a6165', 70, 'Entrepôt Central'),
            ('f7987479-cb8f-450b-b668-3726389e0637', 200, 'Entrepôt Central'),
            ('231af854-6dbf-4bfc-b937-c8d8f95f6e0d', 250, 'Entrepôt Central'),
            ('268cd53f-166c-41cc-b935-2fdbdb37eb26', 50, 'Entrepôt Central'),
            ('a25e28da-af22-4c19-b605-f540e90784c2', 150, 'Entrepôt Central'),
            ('28fc98b3-a654-4f04-9f6a-efe6ada6fc53', 110, 'Entrepôt Central'),
            ('a3c9ceb5-0721-4464-ab33-8944d2f679d1', 130, 'Entrepôt Central'),
            ('e43f8898-a228-4f7a-a6e3-09237a0ebcb3', 90, 'Entrepôt Central'),
            ('4fc0a425-32e9-40c4-bbd8-0a808f6e1856', 95, 'Entrepôt Central');
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM stock_items;');
    }
}
