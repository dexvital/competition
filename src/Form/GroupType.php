<?php

namespace App\Form;

use App\Entity\Groups;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', HiddenType::class)
            ->add('page', HiddenType::class, ['mapped' => false])
            ->add('competition', EntityType::class, [
                'class' => 'App:Competition',
                'choice_label' => 'name',
                'required' => true
            ])
            ->add('name', TextType::class, ['required'=>true])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    Groups::TYPE_ALLVSALL => Groups::TYPE_ALLVSALL,
                    Groups::TYPE_FINAL => Groups::TYPE_FINAL
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Groups::class,
        ]);
    }
}
