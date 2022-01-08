<?php

namespace App\DataFixtures;

use App\Entity\Cars;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Faker\Generator;
use Faker\Provider\Fakecar;
use Faker\Provider\Base;




class CarsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new Fakecar($faker));




        for ($cars = 1; $cars <= 30; $cars++) {
            $categorie = $this->getReference(('categorie_' . $faker->numberBetween(1, 3)));

            $car = new Cars();
            $car->setCategories($categorie);
            $car->setPrice($faker->numberBetween(20, 50));
            // if ($categorie === 1) {
            //     $car->setPrice($faker->randomFloat(2, 20, 50));
            // } else if ($categorie === 2) {
            //     $car->setPrice($faker->randomFloat(2, 500, 1000));
            // } else {
            //     $car->setPrice($faker->randomFloat(2, 100, 200));
            // }
            $car->setTitle($faker->vehicle);
            $car->setContent($faker->realText(30));
            $car->setImage($faker->image('public/uploads/images/cars', '640', '480', 'cars', true, true));
            $manager->persist($car);
        }

        $manager = flush();
    }
    //Ajout d'une dépendence pour qu'elle soit chargé avant
    public function getDependencies()
    {
        return [
            CategoriesFixtures::class
        ];
    }
}
