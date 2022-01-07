<?php

namespace App\DataFixtures;
use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoriesFixtures extends Fixture
{

    //Je crée un tableau pour mes data fictives
    public function load(ObjectManager $manager): void
    {
        $categories = [
            1 => [
                'name' => 'Tourisme',
            ],
            2 => [
                'name' => 'sportive',
            ],
            3 => [
                'name' => 'utilitaires',
            ],

        ];
        // je parcours mon tableau avec ma boucle foreach
        foreach ($categories as $key => $value)
        {
            $categorie = new Categories();
            $categorie->setName($value['name']);
            $manager->persist($categorie);
        }

            $manager->flush();

    }
}
