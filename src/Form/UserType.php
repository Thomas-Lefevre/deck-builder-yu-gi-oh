<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('username', TextType::class)
            ->add('avatar', ChoiceType::class,[
                'choices' => [
                    'Kuriboh 1' => 'img/avatar/5fa7b02ae3dc12de039dc16de712d99c.jpg',
                    'Kuriboh 2' => 'img/avatar/585-5853229_cute-kuriboh-png-download-yugioh-chibi-kuriboh-transparent.png',
                    'Kuriboh 3' => 'img/avatar/avatars-000728542165-i0taki-t500x500.jpg',
                    'Kuriboh 4' => 'img/avatar/tumblr_pmodkrEYEJ1wolsizo1_1280.jpg',
                    'Yugi 1' => 'img/avatar/89484.jpg',
                    'Yugi 2' => 'img/avatar/169719.png',
                    'Yugi 3' => 'img/avatar/192546.jpg',
                    'Yugi 4' => 'img/avatar/219077.png',
                    'Kaiba' => 'img/avatar/190259.png',
                    'Yugi & Kaiba' => 'img/avatar/141240.jpg',
                    'Stardust dragon' => 'img/avatar/62154.jpg',
                    'Black Rose Dragon' => 'img/avatar/83991.png',
                    'Dark Magician Girl' => 'img/avatar/120285.jpg',
                    'Slifer' => 'img/avatar/185090.jpg',
                    'Dark Magician' => 'img/avatar/236249.jpg',
                    'Yubel' => 'img/avatar/c400a744d05b52e94f1135eeef7422060b5053d1r1-544-544v2_00.jpg',
                ],
            ])
            ->add('Update',SubmitType::class);        
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
