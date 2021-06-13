<?php


namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class AdminActionHandler {
  private $entity_manager;

  public function __construct( EntityManagerInterface $em)
    {
        $this->entity_manager = $em;
    }

    protected function hasRights(int $sourceUser)
    {
        $userRoles = $this->entity_manager->getRepository(User::class)->find($sourceUser)->getRoles();
        if (in_array("ROLE_ADMIN", $userRoles))
            return true;
        return false;
    }

    public function deleteUser(int $sourceUser, int $targetUserId) 
    {
      if (!$this->hasRights($sourceUser)) return false;
      $target = $this->entity_manager->getRepository(User::class)->find($targetUserId);
      $this->entity_manager->remove($target);
      $this->entity_manager->flush();
      return true;
    }
}