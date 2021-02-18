<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController {
  /**
     * @Route("/admin/users", name="admin_users")
     */
    public function adminUsers(): Response
    {
      $userRoles = $this->getUser()->getRoles();
      if (!in_array("ROLE_ADMIN", $userRoles))
          return new Response('nope', 510);
      return $this->render('userManagement.html.twig');
    }
}