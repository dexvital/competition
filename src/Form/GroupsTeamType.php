<?php

namespace App\Form;

use App\Entity\GroupsTeam;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class GroupsTeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', HiddenType::class)
            ->add('page', HiddenType::class, ['mapped' => false])
            ->add('group_id', HiddenType::class, ['mapped' => false])
            ->add('team', EntityType::class, [
                'class' => 'App:Team',
                'choice_label' => 'name',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GroupsTeam::class,
        ]);
    }
}
