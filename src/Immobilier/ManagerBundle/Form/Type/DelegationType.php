<?php

// src/Acme/TaskBundle/Form/Type/CategoryType.php
namespace Immobilier\ManagerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Immobilier\ManagerBundle\Entity\Gouvernorat;

class DelegationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
            ->add('idGouvernorat', 'entity', array(
                'class'   => 'Immobilier\ManagerBundle\Entity\Gouvernorat',
                'property'  => 'name',
            ));
            //->add('save', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Immobilier\ManagerBundle\Entity\Delegation',
            'cascade_validation' => false,
        ));
    }

    public function getName()
    {
        return 'delegation';
    }
}

?>