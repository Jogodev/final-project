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
                'name' => 'Sportive',
            ],
            3 => [
                'name' => 'Utilitaires',
            ],

        ];
        // je parcours mon tableau avec ma boucle foreach
        foreach ($categories as $key => $value)
        {
            $categorie = new Categories();
            $categorie->setName($value['name']);
            $manager->persist($categorie);

            //Enregistre la categorie dans une reference et la clé nous permettra de la rappeler sans passé par la bdd
            $this->addReference('categorie_' . $key, $categorie);
        }

            $manager->flush();

    }
}
