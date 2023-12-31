<?php

namespace App\DataFixtures;

use app\Entity\Etat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class EtatFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $etat = new Etat();
        $etat->setLibelle("En création");
        $manager->persist($etat);
        $this->addReference('etat1', $etat);

        $etat = new Etat();
        $etat->setLibelle("Ouverte");
        $manager->persist($etat);
        $this->addReference('etat2', $etat);

        $etat = new Etat();
        $etat->setLibelle("Clôturée");
        $manager->persist($etat);
        $this->addReference('etat3', $etat);

        $etat = new Etat();
        $etat->setLibelle("En cours");
        $manager->persist($etat);
        $this->addReference('etat4', $etat);

        $etat = new Etat();
        $etat->setLibelle("Passée");
        $manager->persist($etat);
        $this->addReference('etat5', $etat);

        $etat = new Etat();
        $etat->setLibelle("Annulée");
        $manager->persist($etat);
        $this->addReference('etat6', $etat);


        $manager->flush();
    }
}
