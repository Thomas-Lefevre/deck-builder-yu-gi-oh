<?php

namespace App\Form;

use App\Entity\Deck;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DeckType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('format', ChoiceType::class,[
                'label' => false,
                'required' => true,
                'choices' => [
                    'Classic' => 'Classic',
                    'Advanced' => 'Advanced',
                    'Speed-Duel' => 'Speed-Duel'
                ],
                'constraints' => [
                    new Choice([
                        'choices' => [
                            'Classic',
                            'Advanced',
                            'Speed-Duel',
                        ],
                        'message' => 'message d\'erreur',
                    ]),
                ]
            ])
            ->add('nom', TextType::class,[
                'required' => true,
                'attr' =>[
                    'placeholder' => 'Deck name'
                ]
            ])
            ->add('type',ChoiceType::class,[
                'label' => false,
                'required' => true,
                'choices' => [
                    'Fun' => 'Fun',
                    'Competitive' => 'Competitive',
                ],
                'constraints' => [
                    new Choice([
                        'choices' => [
                            'Fun',
                            'Competitive',
                        ],
                        'message' => 'message d\'erreur',
                    ]),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Deck::class,
        ]);
    }
}
