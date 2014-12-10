<?php

namespace AppBundle\Form\Type;

use AppBundle\Model\Issue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IssueType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('body')
            ->add('state', 'choice', [
                'choices' => [
                    Issue::STATE_OPEN   => Issue::STATE_OPEN,
                    Issue::STATE_CLOSED => Issue::STATE_CLOSED,
                ],
            ])
            ->add('save', 'submit', ['attr' => ['class' => 'btn-default']])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Model\Issue'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'issue';
    }
} 
