<?php
namespace App\Controller;

use App\Entity\User;
use App\Response\AjaxResponse;
use App\Service\AdminActionHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController {
    /**
     * @Route("/admin/users", name="admin_users")
     */
    public function adminUsers(EntityManagerInterface $em): Response
    {
      $userRoles = $this->getUser()->getRoles();
      if (!in_array("ROLE_ADMIN", $userRoles))
          return new Response('nope', 510);
      $users = $em->getRepository(User::class)->findAll();
      return $this->render('userManagement.html.twig', ["users" => $users]);
    }

    /**
     * @Route("/admin/users/delete/{id}", name="admin_users_delete")
     */
    public function adminUsersDelete($id, AdminActionHandler $adh): Response
    {
      $userRoles = $this->getUser()->getRoles();
      if (!in_array("ROLE_ADMIN", $userRoles))
          return new Response('nope', 510);
      if ($adh->deleteUser($this->getUser()->getId(), $id)) return AjaxResponse::success();
      return AjaxResponse::error();
    }
}