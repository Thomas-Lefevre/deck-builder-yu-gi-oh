<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\CardType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        //création de tableau pour le choice type Archetype
        $json = json_decode(file_get_contents(__DIR__.'/../../public/json/archetype.json'),true);
        $tmp = array_map(function($element) {
            return $element['archetype_name'];
        } , $json);
        $archetypeChoices = array_combine($tmp,$tmp);
        
        $builder
            ->add('q', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Search a card',
                ],
            ])
            ->add('type', EntityType::class, [
                'class'=> CardType::class,
                'label' => false,
                'required' => false,
                'placeholder'=> 'Choise a type of card'
                
            ])
            ->add('race', ChoiceType::class, [
                'required' => false,
                'label' => false,
                'placeholder'=> 'Choise a race of card',
                'choices' => [
                    'Aqua' => 'Aqua',
                    'Beast' => 'Beast',
                    'Beast-Warrior' => 'Beast-Warrior',
                    'Creator God' => 'Creator God',
                    'Cyberse' => 'Cyberse',
                    'Dinosaur' => 'Dinosaur',
                    'Divine-Beast' => 'Divine-Beast',
                    'Dragon' => 'Dragon',
                    'Fairy' => 'Fairy',
                    'Fiend' => 'Fiend',
                    'Fish' => 'Fish',
                    'Insect' => 'Insect',
                    'Machine' => 'Machine',
                    'Plant' => 'Plant',
                    'Psychic' => 'Psychic',
                    'Pyro' => 'Pyro',
                    'Reptile' => 'Reptile',
                    'Rock' => 'Rock',
                    'Sea Serpent' => 'Sea Serpent',
                    'Spellcaster' => 'Spellcaster',
                    'Thunder' => 'Thunder',
                    'Warrior' => 'Warrior',
                    'Winged Beast' => 'Winged Beast',
                    'Wyrm' => 'Wyrm',
                    'Zombie' => 'Zombie',
                ],
                'constraints' => [
                    new Choice([
                        'choices' => [
                            'Aqua',
                            'Beast',
                            'Beast-Warrior',
                            'Creator God',
                            'Cyberse',
                            'Dinosaur',
                            'Divine-Beast',
                            'Dragon',
                            'Fairy',
                            'Fiend',
                            'Fish',
                            'Insect',
                            'Machine',
                            'Plant',
                            'Psychic',
                            'Pyro',
                            'Reptile',
                            'Rock',
                            'Sea Serpent',
                            'Spellcaster',
                            'Thunder',
                            'Warrior',
                            'Winged Beast',
                            'Wyrm',
                            'Zombie',
                        ],
                        'message' => 'message d\'erreur',
                    ]),
                ]
            ])
            ->add('level', ChoiceType::class, [
                'required' => false,
                'label' => false,
                'placeholder'=> 'Choise a level for your monster',
                'choices' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                    '11' => '11',
                    '12' => '12',
                ],
                'constraints' => [
                    new Choice([
                        'choices' => [
                            '1',
                            '2',
                            '3',
                            '4',
                            '5',
                            '6',
                            '7',
                            '8',
                            '9',
                            '10',
                            '11',
                            '12',
                        ],
                        'message' => 'message d\'erreur',
                    ]),
                ]
            ])
            ->add('attribute', ChoiceType::class, [
                'required' => false,
                'label' => false,
                'placeholder'=> 'Choise a attribute for your card',
                'choices' => [
                    'DARK' => 'DARK',
                    'DIVINE' => 'DIVINE',
                    'EARTH' => 'EARTH',
                    'FIRE' => 'FIRE',
                    'LIGHT' => 'LIGHT',
                    'WATER' => 'WATER',
                    'WIND' => 'WIND',
                ],
                'constraints' => [
                    new Choice([
                        'choices' => [
                            'DARK',
                            'DIVINE',
                            'EARTH',
                            'FIRE',
                            'LIGHT',
                            'WATER',
                            'WIND',
                        ],
                        'message' => 'message d\'erreur',
                    ]),
                ]
            ])
            ->add('archetype', ChoiceType::class, [
                'required' => false,
                'label' => false,
                'placeholder'=> 'Archetype',
                'choices' => $archetypeChoices,
            ])
            ->add('banlist_info', ChoiceType::class, [
                'required' => false,
                'label' => false,
                'placeholder'=> 'Type of banlist',
                'choices' => [
                    'Banned' => 'Banned',
                    'Limited' => 'Limited',
                    'Semi-Limited' => 'Semi-Limited',
                ],
                'constraints' => [
                    new Choice([
                        'choices' => [
                            'Banned',
                            'Limited',
                            'Semi-Limited',
                        ],
                        'message' => 'message d\'erreur',
                    ]),
                ]
            ])
            ->add('order', ChoiceType::class, [
                'required' => false,
                'label' => false,
                'placeholder'=> 'Order by ( name by default ) ',
                'choices' => [
                    'Attack' => 'atk',
                    'Defense' => 'def',
                    'Level'=>'level',
                    'Attribute'=>'attribute',
                    'Race'=>'race',
                ],
                'constraints' => [
                    new Choice([
                        'choices' => [
                            'nom',
                            'atk',
                            'def',
                            'level',
                            'attribute',
                            'race',
                        ],
                        'message' => 'message d\'erreur',
                    ]),
                ]
            ])
            ->add('Filter', SubmitType::class)
            ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'crsf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
