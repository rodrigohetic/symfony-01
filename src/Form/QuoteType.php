<?php

namespace App\Form;

use App\Entity\Quote;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class QuoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title', TextType::class, [
                'required' => true,
                'label' => 'Titre de la citation'
            ])
            ->add('content', TextareaType::class, [
                'required' => true,
                'label' => 'Markdown'
            ])
            ->add('position', ChoiceType::class,[
                'choices'  => [
                    'null' => null,
                    'aucune' => 'none',
                    'important' => 'important',
                    ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create Quote'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Quote::class,
        ]);
    }
}