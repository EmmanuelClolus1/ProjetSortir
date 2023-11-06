<?php

namespace App\Form;

use App\DataFixtures\CampusFixtures;
use App\Entity\Campus;
use App\Entity\Lieu;
use App\Entity\Sortie;

use App\Entity\Ville;
use App\Repository\LieuRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class , [
                'label' => 'Nom de la sortie',
                'required' => true
            ])
            ->add('dateHeureDebut', DateType::class, [
                'label' => 'Date et heure de la sortie',
                'widget' => 'single_text',
                'required' => true
            ])
            ->add('dateLimiteInscription', DateType::class, [
                'label' => 'Date limite d\'inscription',
                'widget' => 'single_text',
                'required' => true
            ])
            ->add('nbInscriptionMax', IntegerType::class,[
                'label' => 'Nombre de places',
                'required' => true
            ])
            ->add('duree', NumberType::class,[
                'label' => 'Durée',
                'required' => true
            ])
            ->add('infosSortie', TextType::class,[
                'label' => 'Description et infos',
                'required' => true
            ])
            ->add('campus', EntityType::class,[
                'label' => 'campus',
                'class' => Campus::class,
                'choice_label' => 'nom',
                'placeholder' => 'Choissisez un campus',
                'required' => true

            ])
            ->add('ville', EntityType::class,[
                'label' => 'Ville',
                'placeholder' => 'Sélectionner une ville',
                'class' => Ville::class,
                'choice_label' => 'nom',
                'mapped' => false,
                'required' => true
            ])
            ->add('lieu', EntityType::class,[
                'label' => 'lieu',
                'placeholder'=> 'Sélectionner un lieu',
                'class'=>Lieu::class,
                'choice_label'=>'nom',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
