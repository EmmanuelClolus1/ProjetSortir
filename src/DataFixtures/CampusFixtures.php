<?php

namespace App\DataFixtures;

use app\Entity\Campus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class CampusFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $faker = \Faker\Factory::create('fr_FR');

       for($i = 1; $i<= 10;$i++){
           $campus = new Campus();
           $campus->setNom($faker->name());
           $manager->persist($campus);
           $this->addReference('campus'. $i, $campus);
       }

        $manager->flush();
    }
}
