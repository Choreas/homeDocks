<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class CombinedFixtures extends Fixture
{
    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
        $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername("user001");
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'user001'
        ));
        $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);

        $manager->persist($user);
        $manager->flush();
    }
}
