<?php

namespace App\DataFixtures;

use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VilleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = \Faker\Factory::create('fr_FR');

        //Création de 10 villes supplémentaires
        for($i =1; $i <= 10; $i++) {
            $ville =new Ville();
        $ville->setNom($faker->city());
        $ville->setCodePostal($faker->postcode());
        $manager->persist($ville);

       // $this->addReference('ville'.$i);
}
        $manager->flush();
    }

}
