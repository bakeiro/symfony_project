<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\User;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200214132937 extends AbstractMigration implements ContainerAwareInterface
{    
    use ContainerAwareTrait;

    /*
    private $container;
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    */

    
    public function getDescription() : string
    {
        return '';
    }

    /**
     * Create the db structure and insert 2 sample users
     */
    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, age INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    /**
     * Creates users and inserts them into the db
     */
    public function postUp(Schema $schema) : void
    {
        $admin_master = new User();
        $admin_master->setLastName("master");
        $admin_master->setName("admin");
        $admin_master->setAge(37);
        $admin_master->setPassword("thisIsAPassword");
        $admin_master->setEmail("adminmaster@email.com");
        $admin_master->setRoles(array("ROLE_ADMINMASTER", "ROLE_USER"));
        
        $normal_user = new User();
        $normal_user->setLastName("user");
        $normal_user->setName("normal");
        $normal_user->setAge(25);
        $normal_user->setPassword("thisIsAPassword2");
        $normal_user->setEmail("normaluser@email.com");
        $normal_user->setRoles(array("ROLE_USER"));
    
        $manager = $this->container->get('doctrine.orm.entity_manager');
        $manager->persist($admin_master);
        $manager->flush();
        
        $manager->persist($normal_user);
        $manager->flush();
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
    }
}
