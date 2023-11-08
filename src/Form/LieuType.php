<?php

namespace App\Form;

use App\Entity\Lieu;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LieuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                'label' => 'Nom du lieu',
                'required' => true
            ] )
            ->add('rue', TextType::class, [
                'label' => 'rue',
                'required' => true
            ])
            ->add('latitude', NumberType::class, [
                'label' => 'Latitude',
                'required' => true
            ])
            ->add('longitude', NumberType::class, [
                'label' => 'Latitude',
                'required' => true
            ])
            ->add('ville', EntityType::class, [
                'label' => 'ville',
                'class' => Ville::class,
                'choice_label'=>'nom',
                'placeholder' => 'veuillez choisir une ville',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lieu::class,
        ]);
    }
}
