<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Participant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ParticipantType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class)
            ->add('plainPassword', RepeatedType::class, [
                'type'=>PasswordType::class,
                'invalid_message'=>'Le mot de passe doit correspondre dans les deux champs',
                'mapped' => false,
                'options'=>['attr'=>['class'=>'password-field']],
                'required'=>false,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmation mot de passe'],
                'constraints' => [

                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => "/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[ !\"\#\$%&\'\(\)*+,\-.\/:;<=>?@[\\^\]_`\{|\}~])^.{0,4096}$/",
                        'message' => 'Le mot de passe doit contenir obligatoirement une minuscule, une majuscule, un chiffre et un caractère spécial.',
                    ])
                ],
            ])

            ->add('telephone',TextType::class,[
                'label'=>'Téléphone',
                'required'=>false,
            ])
            ->add('nom',TextType::class,[
                'label'=>'Nom'
            ])
            ->add('prenom',TextType::class,[
                'label'=>'Prénom'
            ])
            ->add("campus",EntityType::class,[
                'class'=>Campus::class,'choice_label'=>'nom'])
            ->add('image',FileType::class,[
               'mapped'=>false,
               'required'=>false,
               'constraints'=>[
                   new File([
                       'maxSize'=>'1M',
                       'mimeTypes'=>[
                           'image/jpeg',
                           'image/png',
                       ],
                       'mimeTypesMessage'=>'Please upload a valid image',
                   ])
               ]
            ]);
//            ->add('delete',CheckboxType::class,[
//              'label'=>"supprimer l'image",
//              'required'=>false,
//                'mapped'=>false,
//            ]);
            
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event){
            $participant = $event->getData();
            if ($participant && $participant->getFilename()){
                $form = $event->getForm();
                $form->add('deleteImage',CheckboxType::class,[
                    'label'=>"supprimer l'image",
                    'required'=>false,
                    'mapped'=>false,
                ]);
            }
        });

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
