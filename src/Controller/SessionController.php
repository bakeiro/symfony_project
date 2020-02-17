<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Form\UserLoginForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    public function index()
    {
        $user_entity = new User();
        $login_form = $this->createForm(UserLoginForm::class, $user_entity);
        $login_form = $login_form->createView();

        $data = array("controller_name" => "SessionController", "login_form" => $login_form);
        return $this->render("session/session_index.html.twig", $data);
    }

    public function checkLogin(Request $request, SessionInterface $session)
    {
        $user_entity = new User();
        $login_form_submitted = $this->createForm(UserLoginForm::class, $user_entity);
        $login_form_submitted->handleRequest($request);

        if ($login_form_submitted->isSubmitted() && $login_form_submitted->isValid()) {

            $user_entity = $login_form_submitted->getData();
            $post_email = $user_entity->getEmail();
            $post_password = $user_entity->getPassword();

            if($request->hasSession()) {
                if($session->get("logged_user") === true){
                    $this->addFlash("feedback_message", "Session already started");
                } else {
                    // Use the db and with different roles, and use these roles later
                    // I don"t use the DB in this example cause I want to do it quickly and focus on Session stuff
                    if($post_email === "admin" && $post_password === "123") {
                        $this->addFlash("feedback_message", "logged!");
                        $session->set("logged_user", true);
                        $session->set("session_time", date_format(new DateTime(), "Y-m-d H:i:s"));
                        $session->set("user_role", "value");
                    } else {
                        $this->addFlash("feedback_message", "Incorrect credentials :(");
                    }
                }
            }
        }

        $response = new RedirectResponse("/session_test");
        return $response;
    }

    public function logOut(SessionInterface $session)
    {
        //$session->start();
        $session->clear();

        $response = new RedirectResponse("/session_test");
        return $response;
    }
}
