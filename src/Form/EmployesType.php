<?php

namespace App\Form;

use App\Entity\Employes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class EmployesType extends AbstractType
{
    public function annes(){
        $arr =[];
        $anneActuel = date('Y');
        for($i = $anneActuel - 18 ; $i > 1950; $i-- ){
            $arr[] =  $i;
        }

        return $arr;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class, [
                "label" => 'Prénom',
                'required' => false,
                
                'attr' => [
                    'placeholder' => 'Saisir le prénom',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'le prénom est obligatoir']),
                    new Length([
                        'min' => 5,
                        'max' => 55,
                        'minMessage' => '5 min',
                        'maxMessage' => '55 max'
                    ])
                ]
            ])


            ->add('nom' , TextType::class, [
                "label" => 'Nom',
                'required' => false,
                
                'attr' => [
                    'placeholder' => 'Saisir le nom ',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Saisir le nom est obligatoir']),
                    new Length([
                        'min' => 5,
                        'max' => 55,
                        'minMessage' => '5 min',
                        'maxMessage' => '55 max'
                    ])
                ]
            ])


            ->add('telephone' , TelType::class, [
                "label" => 'Téléphone',
                'required' => false,
                
                'attr' => [
                    'placeholder' => 'Saisir numéro de téléphone',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Saisir numéro de téléphone est obligatoir']),
                    new Length([
                        'min' => 10,
                        'max' => 13,
                        'minMessage' => '10 min',
                        'maxMessage' => '13 max'
                    ])
                ]
            ])


            ->add('email' , EmailType::class, [
                "label" => 'Email',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Saisir un email',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Saisir l\'adresse mail est obligatoir']),
                    new Length([
                        'min' => 10,
                        'max' => 50,
                        'minMessage' => '10 min',
                        'maxMessage' => '50 max'
                    ])
                ]
            ])


            ->add('adresse'  , TextType::class, [
                "label" => 'Adresse',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Saisir l\'adresse',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Saisir l\'adresse est obligatoir']),
                    new Length([
                        'min' => 10,
                        'max' => 350,
                        'minMessage' => '10 min',
                        'maxMessage' => '350 max'
                    ])
                ]
            ])


            ->add('poste' , TextType::class, [
                "label" => 'Poste',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Saisir le poste',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Saisir le poste est obligatoir']),
                    new Length([
                        'min' => 5,
                        'max' => 25,
                        'minMessage' => '5 min',
                        'maxMessage' => '25 max'
                    ])
                ]
            ])


            ->add('salaire' , MoneyType::class, [
                'currency' => 'EUR',
                'required' => false,
                'label' => 'Salaire'
            ])
            

            ->add('datadenaissance' , DateType::class , [
                "label" => 'Date de naissance',
                'required' => false,
                'years' => $this->annes(),
                'attr' => [
                    'placeholder' => 'Saisir la date de naissance',
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Saisir la date de naissance est obligatoir']) 
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employes::class,
        ]);
    }
}
