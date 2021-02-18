<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController {
    /**
     * @Route("/", name="landing")
     */
    public function landing(): Response
    {
        return $this->render('landing.html.twig', ['user' => $this->getUser()]);
    }
}