<?php

namespace App\DataFixtures;

use App\Entity\Users;
use App\Entity\Cars;
use App\Entity\Categories;
use App\Entity\Sales;
use App\Entity\Bookings;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Faker\Provider\Fakecar;


class AppFixtures extends Fixture
{

    public function __construct(UserPasswordHasherInterface $hash)
    {
        $this->hash = $hash;
    }

    /**
     * Method load Permet de généré des fausses données dans la bdd pour faire des tests
     *
     * @param ObjectManager $manager [explicite description]
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        //Fakecar pour avoir des noms de voiture pour que ce soit plus coherent avec le projet
        $faker->addProvider(new Fakecar($faker));

        $categories = [
            1 => [
                'name' => 'Tourisme',
            ],
            2 => [
                'name' => 'Sportive',
            ],
            3 => [
                'name' => 'Utilitaires',
            ],

        ];
        // je parcours mon tableau avec ma boucle foreach
        foreach ($categories as $key => $value) {
            $categorie = new Categories();
            $categorie->setName($value['name']);
            $manager->persist($categorie);
            //Enregistre la categorie dans une reference et la clé nous permettra de la rappeler sans passé par la bdd
            $this->addReference('categorie_' . $key, $categorie);
        }
        //Génère les voitures de location
        for ($cars = 1; $cars <= 30; $cars++) {
            $categorie = $this->getReference(('categorie_' . $faker->numberBetween(1, 3)));
            $car = new Cars();
            $car->setCategories($categorie);
            //petit algo pour que les prix et les images soit coherent par rapport aux categories
            if ($categorie === $this->getReference(('categorie_' . 1))) {
                $car->setPrice($faker->randomFloat(2, 20, 50));
                $car->setImage('/uploads/images/golf.jpg');
            } elseif ($categorie === $this->getReference(('categorie_' . 2))) {
                $car->setPrice($faker->randomFloat(2, 500, 1500));
                $car->setImage('/uploads/images/audi.jpg');
            } else {
                $car->setPrice($faker->randomFloat(2, 100, 200));
                $car->setImage('/uploads/images/20m3.jpg');
            }
            $car->setTitle($faker->vehicle);
            $car->setContent($faker->words(10, true));
            $car->setEnergy($faker->vehicleFuelType);
            $manager->persist($car);
            $this->addReference('car_' . $cars, $car);
        }

        for ($users = 1; $users <= 10; $users++) {
            $user = new Users();
            //le 1er user a le role admin 
            //La 1ere adresse mail est la mienne
            if ($users === 1) {
                $user->setRoles(['ROLE_ADMIN']);
                $user->setEmail('jonathan.plastivene@gmail.com');
            } else {
                $user->setRoles(['ROLE_USER']);
                $user->setEmail($faker->email);
            }

            $user->setPassword($this->hash->hashPassword($user, '123456'));
            $user->setLastname($faker->lastname);
            $user->setFirstname($faker->firstname);
            $user->setIsVerified($faker->numberBetween(0, 1));
            $user->setTel("0632337896");
            $manager->persist($user);

            $this->addReference('user_' . $users, $user);
        }
        //Génère des voitures pour la pages vente
        for ($sales = 1; $sales <= 10; $sales++) {
            $sale = new Sales();
            $sale->setTitle($faker->vehicle);
            $sale->setImage("/uploads/images/merco.jpg");
            $sale->setPrice($faker->randomFloat(2, 5000, 15000));
            $sale->setDescription($faker->words(15, true));
            $manager->persist($sale);
        }
        // //Génère des reservations
        // for ($bookings = 1; $bookings <= 10; $bookings++) {
        //     $car = $this->getReference(('car_' . $faker->numberBetween(1, 30)));
        //     $user = $this->getReference(('user_' . $faker->numberBetween(1, 10)));
        //     $booking = new Bookings();
        //     $booking->setUser($user);
        //     $booking->setCars($car);
        //     $booking->setCreatedAt($faker->dateTimeInInterval('-6 days', '+4 days', 'Europe/Paris'));
        //     $booking->setStartDate($faker->dateTimeBetween('-5 days', '+5 days', 'Europe/Paris'));
        //     $booking->setEndDate($faker->dateTimeBetween('-3 days', '+10 days', 'Europe/Paris'));
        //     $manager->persist($booking);
        // }

        $manager->flush();
    }
}
