<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240602005409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE public.Products RENAME id_company TO id_company_id');
        $this->addSql('CREATE INDEX IDX_8820E36532119A01 ON public.Products (id_company_id)');
        $this->addSql('ALTER TABLE public.Products ADD CONSTRAINT FK_8820E36532119A01 FOREIGN KEY (id_company_id) REFERENCES public.Company (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
