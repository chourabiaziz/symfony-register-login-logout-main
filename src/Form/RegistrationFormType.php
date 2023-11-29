<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
 use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType; // Import FileType
 use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        ->add('username')
        ->add('age', TextType::class, [
            'required' => true,

            'label' => 'Age',
            'label_attr' => ['style' => 'color: black;'], // Set label color to black

        ])
      

        ->add('sexe', ChoiceType::class, [
            'required' => true,

            'choices' => [
                'Masculin' => 'Masculin',
                'Féminin' => 'Féminin',
            ],
            
            'label_attr' => ['style' => 'color: black;'], // Set label color to black
        ])
        
        ->add('roles', ChoiceType::class, [
            'required' => true,
            'choices' => [
                'Medecin' => 'Medecin',
                'Coach' => 'Coach',
                'Client' => 'Client',
            ],
            'label' => 'Roles',
            'label_attr' => ['style' => 'color: black;'],
            'multiple' => true, // Allow selecting multiple roles
            // Optionally, you can set the initial roles using the 'data' option:
            // 'data' => ['Medecin'], // Initial selected roles
        ])
        ->add('image', FileType::class, [
            'required' => true,
            'label' => 'Télécharger une image',
            'label_attr' => ['style' => 'color: black;'], // Set label color to black
        ])


            ->add('email')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
