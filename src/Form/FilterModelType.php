<?php

namespace App\Form;


use App\Entity\Campus;
use App\Form\Model\FilterModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;

class FilterModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('filtreRecherche', TextType::class, array(
                'label' => 'Le nom de la sortie contient : ',
                'required' => false))


            ->add('filtreCampus', EntityType::class, [
                'label' => 'Campus : ',
                'class' => Campus::class, 'choice_label' => 'nom',
                'required' => false])


            ->add('dateDebut', DateType::class, [
                'label' => 'entre :',
                'required' => false,
                'widget' => 'single_text'
            ])
            ->add('dateFin', DateType::class,  [
                'label' => 'et :',
                'required' => false,
                'widget' => 'single_text'
            ])

            ->add('sortieInscrit', CheckboxType::class, [
                'label'=>'Je suis inscrit/inscrite',
                'required' => false])

            ->add('sortiePassees', CheckboxType::class, [
                'label'=>'La sortie est passée',
                'required'=>false])

            ->add('sortieOrganisateur', CheckboxType::class, [
                'label'=>'Je suis organisateur/organisatrice',
                'required'=>false])

            ->add('sortiePasInscrit', CheckboxType::class, [
                'label'=>'Sorties auxquelles je ne suis pas inscrit/e',
                'required'=>false
            ])

            ->add('rechercher', SubmitType::class);

    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FilterModel::class,
        ]);
    }
}
