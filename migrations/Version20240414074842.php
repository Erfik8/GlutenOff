<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240414074842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE adresses_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE city_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE company_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE Products DROP CONSTRAINT id_category');
        $this->addSql('ALTER TABLE Products DROP CONSTRAINT id_company');
        $this->addSql('ALTER TABLE List_shop_likes DROP CONSTRAINT id_shop');
        $this->addSql('ALTER TABLE List_shop_likes DROP CONSTRAINT id_user');
        $this->addSql('ALTER TABLE List_product_user DROP CONSTRAINT id_product');
        $this->addSql('ALTER TABLE List_product_user DROP CONSTRAINT id_user');
        $this->addSql('ALTER TABLE Shops DROP CONSTRAINT id_adresses');
        $this->addSql('ALTER TABLE Users DROP CONSTRAINT id_city');
        $this->addSql('ALTER TABLE Users DROP CONSTRAINT id_user_type');
        $this->addSql('DROP TABLE Products');
        $this->addSql('DROP TABLE List_shop_likes');
        $this->addSql('DROP TABLE List_product_user');
        $this->addSql('DROP TABLE Shops');
        $this->addSql('DROP TABLE Users');
        $this->addSql('ALTER TABLE Adresses DROP CONSTRAINT id_city');
        $this->addSql('DROP INDEX IDX_166F4704A67B1E36');
        $this->addSql('ALTER TABLE Adresses ALTER id TYPE INT');
        $this->addSql('ALTER TABLE Adresses ALTER street TYPE TEXT');
        $this->addSql('ALTER TABLE Adresses ALTER postal_code TYPE TEXT');
        $this->addSql('ALTER TABLE Adresses ALTER accomodation TYPE TEXT');
        $this->addSql('ALTER TABLE Category ALTER id TYPE INT');
        $this->addSql('ALTER TABLE Category ALTER name TYPE TEXT');
        $this->addSql('ALTER TABLE City ALTER id TYPE INT');
        $this->addSql('ALTER TABLE City ALTER name TYPE TEXT');
        $this->addSql('ALTER TABLE Company ALTER id TYPE INT');
        $this->addSql('ALTER TABLE Company ALTER name TYPE TEXT');
        $this->addSql('ALTER TABLE Company ALTER country TYPE TEXT');
        $this->addSql('ALTER TABLE User_type ALTER id TYPE INT');
        $this->addSql('ALTER TABLE User_type ALTER name TYPE TEXT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE adresses_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE city_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE company_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_type_id_seq CASCADE');
        $this->addSql('CREATE TABLE Products (id BIGINT NOT NULL, id_category BIGINT NOT NULL, id_company BIGINT NOT NULL, name VARCHAR(255) NOT NULL, gluten_free BOOLEAN NOT NULL, vegan BOOLEAN NOT NULL, vegetarian BOOLEAN NOT NULL, lactose_free BOOLEAN NOT NULL, description VARCHAR(255) NOT NULL, logo_link VARCHAR(255) DEFAULT \'\\public\\images\\sloik.png\', PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4ACC380C5697F554 ON Products (id_category)');
        $this->addSql('CREATE INDEX IDX_4ACC380C9122A03F ON Products (id_company)');
        $this->addSql('CREATE TABLE List_shop_likes (id BIGINT NOT NULL, id_shop BIGINT NOT NULL, id_user BIGINT NOT NULL, userlike BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DC345E6D274A50A0 ON List_shop_likes (id_shop)');
        $this->addSql('CREATE INDEX IDX_DC345E6D6B3CA4B ON List_shop_likes (id_user)');
        $this->addSql('CREATE TABLE List_product_user (id BIGINT NOT NULL, id_product BIGINT NOT NULL, id_user BIGINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_543D2309DD7ADDD ON List_product_user (id_product)');
        $this->addSql('CREATE INDEX IDX_543D23096B3CA4B ON List_product_user (id_user)');
        $this->addSql('CREATE TABLE Shops (id BIGINT NOT NULL, id_adress BIGINT NOT NULL, name VARCHAR(255) NOT NULL, google_share_link VARCHAR(255) DEFAULT \'\', photo_link VARCHAR(255) DEFAULT \'\\public\\images\\sloik.png\', gluten_free BOOLEAN NOT NULL, vegan BOOLEAN NOT NULL, vegatarian BOOLEAN NOT NULL, lactose_free BOOLEAN NOT NULL, google_embeded_link VARCHAR(255) DEFAULT NULL, logo_link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E2BB48877ADB7253 ON Shops (id_adress)');
        $this->addSql('CREATE TABLE Users (id BIGINT NOT NULL, id_user_type BIGINT NOT NULL, id_city BIGINT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, logo_link VARCHAR(255) DEFAULT \'\\public\\images\\profile.png\', premium_ending_date DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D5428AEDA67B1E36 ON Users (id_city)');
        $this->addSql('CREATE INDEX IDX_D5428AED766AA7C7 ON Users (id_user_type)');
        $this->addSql('ALTER TABLE Products ADD CONSTRAINT id_category FOREIGN KEY (id_category) REFERENCES "Category" (id) ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Products ADD CONSTRAINT id_company FOREIGN KEY (id_company) REFERENCES "Company" (id) ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE List_shop_likes ADD CONSTRAINT id_shop FOREIGN KEY (id_shop) REFERENCES "Shops" (id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE List_shop_likes ADD CONSTRAINT id_user FOREIGN KEY (id_user) REFERENCES "Users" (id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE List_product_user ADD CONSTRAINT id_product FOREIGN KEY (id_product) REFERENCES "Products" (id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE List_product_user ADD CONSTRAINT id_user FOREIGN KEY (id_user) REFERENCES "Users" (id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Shops ADD CONSTRAINT id_adresses FOREIGN KEY (id_adress) REFERENCES "Adresses" (id) ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Users ADD CONSTRAINT id_city FOREIGN KEY (id_city) REFERENCES "City" (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE Users ADD CONSTRAINT id_user_type FOREIGN KEY (id_user_type) REFERENCES "User_type" (id) ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE category ALTER id TYPE BIGINT');
        $this->addSql('ALTER TABLE category ALTER name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_type ALTER id TYPE BIGINT');
        $this->addSql('ALTER TABLE user_type ALTER name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE adresses ALTER id TYPE BIGINT');
        $this->addSql('ALTER TABLE adresses ALTER street TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE adresses ALTER postal_code TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE adresses ALTER accomodation TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE adresses ADD CONSTRAINT id_city FOREIGN KEY (id_city) REFERENCES "City" (id) ON UPDATE RESTRICT ON DELETE RESTRICT NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_166F4704A67B1E36 ON adresses (id_city)');
        $this->addSql('ALTER TABLE company ALTER id TYPE BIGINT');
        $this->addSql('ALTER TABLE company ALTER name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE company ALTER country TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE city ALTER id TYPE BIGINT');
        $this->addSql('ALTER TABLE city ALTER name TYPE VARCHAR(255)');
    }
}
