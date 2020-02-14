<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use App\Entity\User;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200214132937 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, age INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        // TODO: this is a test
        $admin_master = new User();
        $admin_master->setLastName("master");
        $admin_master->setAge(25);
        $admin_master->setPassword("thisIsAPassword");
        $admin_master->setEmail("adminmaster@email.com");
        $admin_master->setRoles(array("ROLE_ADMINMASTER", "ROLE_USER"));
        
        $admin_master->setLastName("master");

        // email`, `roles`, `password`, `last_name`, `name`, `age
        
        $this->addSql('INSERT INTO user (`email`, `roles`, `password`, `last_name`, `name`, `age`) VALUES ("admin_master@email.com", "ROLE_ADMIN", "thisisatest", "master", "admin", 35)');
        $this->addSql('INSERT INTO user (`email`, `roles`, `password`, `last_name`, `name`, `age`) VALUES ("admin_test@email.com", "ROLE_TEST", "thisisatest_2", "test", "test", 25)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
    }
}
