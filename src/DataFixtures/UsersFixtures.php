<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\hash\UserPasswordhashInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{

    private $hash;

    public function __construct(UserPasswordHasherInterface $hash)
    {
        $this->hash = $hash;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        //Je crée 10 users
        for ($users = 1; $users <= 10; $users++) {
            $user = new Users();
            $user->setEmail($faker->email);
            //le 1er user a le role admin
            if ($users === 1) {
                $user->setRoles(['ROLE_ADMIN']);
            } else {
                $user->setRoles(['ROLE_USER']);
            }
            $user->setPassword($this->hash->hashPassword($user, '1234'));
            $user->setLastname($faker->lastname);
            $user->setFirstname($faker->firstname);
            $user->setIsVerified($faker->numberBetween(0, 1));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
