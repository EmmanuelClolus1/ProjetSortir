<?php

namespace App\DataFixtures;

use App\Entity\Participant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ParticipantFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasher){

    }
    public function load(ObjectManager $manager): void
    {
       $faker=\Faker\Factory::create('fr_FR');

       for ($i = 1; $i <= 10;$i++){

           $participant = new Participant();

           $participant->setNom($faker->lastName());
           $participant->setPrenom($faker->firstName());
           $participant->setTelephone($faker->phoneNumber());
           $participant->setMail('user'.$i.'@test.fr');
           $motPasse = $this->userPasswordHasher->hashPassword($participant,'123456');
           $participant->setMotPasse($motPasse);
           $participant->setCampus($this->getReference('campus'. $i));
           $manager->persist($participant);
           $this->addReference('organisateur'.$i,$participant);

       }

        $manager->flush();
    }

    public function getDependencies(){
        return [
          CampusFixtures::class,
            SortieFixtures::class
        ];
    }
}
