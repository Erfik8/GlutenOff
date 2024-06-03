<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601181924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE public.Adresses_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.Category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.City_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.Company_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.List_product_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.List_shop_likes_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.Products_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.Shops_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.User_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.Users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE public.Adresses (id INT NOT NULL, street TEXT NOT NULL, postal_code TEXT NOT NULL, accomodation TEXT NOT NULL, id_city BIGINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE public.Category (id INT NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE public.City (id INT NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE public.Company (id INT NOT NULL, name TEXT NOT NULL, country TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE public.List_product_user (id INT NOT NULL, id_product VARCHAR(255) NOT NULL, id_user VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE public.List_shop_likes (id INT NOT NULL, userlike BOOLEAN NOT NULL, id_shop VARCHAR(255) NOT NULL, id_user VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE public.Products (id INT NOT NULL, id_category_id INT NOT NULL, name TEXT NOT NULL, gluten_free BOOLEAN NOT NULL, vegan BOOLEAN NOT NULL, vegetarian BOOLEAN NOT NULL, lactose_free BOOLEAN NOT NULL, description TEXT NOT NULL, logo_link VARCHAR(255) DEFAULT NULL, id_company INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8820E365A545015 ON public.Products (id_category_id)');
        $this->addSql('CREATE TABLE public.Shops (id INT NOT NULL, id_adress_id INT NOT NULL, name TEXT NOT NULL, google_share_link TEXT DEFAULT NULL, photo_link TEXT DEFAULT NULL, gluten_free BOOLEAN NOT NULL, vegan BOOLEAN NOT NULL, vegetarian BOOLEAN NOT NULL, lactose_free BOOLEAN NOT NULL, google_embeded_link TEXT DEFAULT NULL, logo_link TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D36A29E34B3458B ON public.Shops (id_adress_id)');
        $this->addSql('CREATE TABLE public.User_type (id INT NOT NULL, name TEXT NOT NULL, value INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE public.Users (id INT NOT NULL, id_user_type INT NOT NULL, id_city INT NOT NULL, email TEXT NOT NULL, password TEXT NOT NULL, name TEXT NOT NULL, surname TEXT NOT NULL, logo_link TEXT DEFAULT NULL, premium_ending_date DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E493EB89766AA7C7 ON public.Users (id_user_type)');
        $this->addSql('CREATE INDEX IDX_E493EB89A67B1E36 ON public.Users (id_city)');
        $this->addSql('ALTER TABLE public.Products ADD CONSTRAINT FK_8820E365A545015 FOREIGN KEY (id_category_id) REFERENCES public.Category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public.Shops ADD CONSTRAINT FK_D36A29E34B3458B FOREIGN KEY (id_adress_id) REFERENCES public.Adresses (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public.Users ADD CONSTRAINT FK_E493EB89766AA7C7 FOREIGN KEY (id_user_type) REFERENCES public.User_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public.Users ADD CONSTRAINT FK_E493EB89A67B1E36 FOREIGN KEY (id_city) REFERENCES public.City (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE public.Adresses_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.Category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.City_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.Company_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.List_product_user_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.List_shop_likes_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.Products_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.Shops_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.User_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.Users_id_seq CASCADE');
        $this->addSql('ALTER TABLE public.Products DROP CONSTRAINT FK_8820E365A545015');
        $this->addSql('ALTER TABLE public.Shops DROP CONSTRAINT FK_D36A29E34B3458B');
        $this->addSql('ALTER TABLE public.Users DROP CONSTRAINT FK_E493EB89766AA7C7');
        $this->addSql('ALTER TABLE public.Users DROP CONSTRAINT FK_E493EB89A67B1E36');
        $this->addSql('DROP TABLE public.Adresses');
        $this->addSql('DROP TABLE public.Category');
        $this->addSql('DROP TABLE public.City');
        $this->addSql('DROP TABLE public.Company');
        $this->addSql('DROP TABLE public.List_product_user');
        $this->addSql('DROP TABLE public.List_shop_likes');
        $this->addSql('DROP TABLE public.Products');
        $this->addSql('DROP TABLE public.Shops');
        $this->addSql('DROP TABLE public.User_type');
        $this->addSql('DROP TABLE public.Users');
    }
}
