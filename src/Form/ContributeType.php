<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\User;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContributeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user_name', null, [
                'help' => 'Choose whatever pseudo you want. You can changer everytime you want. Pseudo are not reserved.'
            ])
            ->add('game')
            ->add('screenshoot', FileType::class, ['mapped' => false])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
