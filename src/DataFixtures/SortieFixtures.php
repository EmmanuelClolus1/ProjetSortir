<?php

namespace App\DataFixtures;

use App\Entity\Sortie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class SortieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       for ($i = 1; $i <= 10; $i++){
           $faker = \Faker\Factory::create('fr_FR');
           $sortie = new Sortie();
           $sortie->setNom($faker->text(50));
           $sortie->setDateHeureDebut($faker->dateTimeBetween('-1 month', '+1 month'));
           $sortie->setDuree($faker->numberBetween(60, 120));
           $sortie->setDateLimiteInscription($faker->dateTimeBetween('now','+2 month'));
           $sortie->setNbInscriptionMax($faker->numberBetween(1,12));
           $sortie->setInfosSortie($faker->text);
           $manager->persist($sortie);
       }
        $manager->flush();
    }
}
