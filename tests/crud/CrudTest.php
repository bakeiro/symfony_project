<?php

namespace App\Tests\Crud;

use Monolog\Test\TestCase;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CrudTest extends WebTestCase
{
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function logIn()
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        $login_form = $client->selectButton('.ui.button.primary')->form();

        // TODO: What about don't hardcode this values?
        $form["email"] = "adminmaster@email.com";
        $form["password"] = "thisIsAPassword";

        $client = $form->submit($form); // Logged?
    }

    public function testGetUsers()
    {
        $this->logIn();

        $client = static::createClient();
        $client->request('GET', '/crud_test');

        

        /*
        $user_repository = $this->objectManager->getRepository(User::class);
        $all_users = $user_repository->findAll();

        $count_all_users = count($all_users);

        $client = static::createClient();

        // Log in

        // See how many divs
        
        // button.ui.default.button.mini.edit_button

        */
    }

    public function testAddUser()
    {
        $user_to_insert = new User();

    }

    public function testEditUser()
    {

    }

    public function testDeleteUser()
    {

    }
}