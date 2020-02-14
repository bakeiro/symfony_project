<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserEditForm;
use App\Form\UserCreateForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\TestService;

class CrudController extends AbstractController
{
    public function index(TestService $test_service)
    {
        $test_service_message = $test_service->test();

        $all_users = $this->getDoctrine()->getRepository(User::class)->findAll();

        $user_entity = new User();
        $create_user_form = $this->createForm(UserCreateForm::class, $user_entity);
        $create_user_form = $create_user_form->createView();

        $edit_user_form = $this->createForm(UserEditForm::class, $user_entity);
        $edit_user_form = $edit_user_form->createView();

        $data = array("users" => $all_users, "create_user_form" => $create_user_form, "edit_user_form" => $edit_user_form, "test_service_message" => $test_service_message);
        return $this->render("crud/crud_index.html.twig", $data);
    }

    public function deleteUser($user_id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($user_id);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($user);
        $manager->flush();

        $this->addFlash("feedback_message", "User deleted!");

        $response = new RedirectResponse("/crud_test");
        return $response;
    }

    public function insertUser(Request $request)
    {
        $user_to_insert = new User();
        $form = $this->createForm(UserCreateForm::class, $user_to_insert);   
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user_to_insert = $form->getData();

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user_to_insert);
            $manager->flush();
            $this->addFlash("feedback_message", "User created!");
        } else {
            $this->addFlash("feedback_message", "Incorrect data!, check the form and submit it again");
        }

        $response = new RedirectResponse("/crud_test");
        return $response;
    }

    public function updateUser(Request $request)
    {
       $user_to_update = new User();
       $form_update_user = $this->createForm(UserEditForm::class, $user_to_update);
       $form_update_user->handleRequest($request);

        if($form_update_user->isSubmitted() && $form_update_user->isValid()) {

            $updated_user_info = $form_update_user->getData();
            $user_id_to_update = $form_update_user->get("id")->getData();
            
            $original_user = $this->getDoctrine()->getRepository(User::class)->find($user_id_to_update);

            $original_user->setName($updated_user_info->getName());
            $original_user->setLastName($updated_user_info->getLastName());
            $original_user->setAge($updated_user_info->getAge());
            $original_user->setPassword($updated_user_info->getPassword());
            $original_user->setEmail($updated_user_info->getEmail());

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($original_user);
            $manager->flush();

            $this->addFlash("feedback_message", "User updated!");
        } else {
            $this->addFlash("feedback_message", "Incorrect data!, check the form and submit it again");
        }

        $response = new RedirectResponse("/crud_test");
        return $response;
    }

    public function getUserInfo($user_id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($user_id);
        return $this->json($user);
    }
}
