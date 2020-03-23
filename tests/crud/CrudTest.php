<?php

namespace App\Tests\Crud;

use Monolog\Test\TestCase;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class CrudTest extends TestCase
{
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function testGetUsers()
    {
        $user_repository = $this->objectManager->getRepository(User::class);
        $all_users = $user_repository->findAll();

        $count_all_users = count($all_users);

        // Get the welcome page and count how many divs??
        

    }

    public function testAddUser()
    {

    }

    public function testEditUser()
    {

    }

    public function testDeleteUser()
    {

    }
}