<?php

// src/Acme/TaskBundle/Form/Type/CategoryType.php
namespace Immobilier\ManagerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Immobilier\ManagerBundle\Entity\Pays;

class GouvernoratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
            ->add('idPays', 'entity', array(
                'class'   => 'Immobilier\ManagerBundle\Entity\Pays',
                'property'  => 'name',
            ));
            //->add('save', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Immobilier\ManagerBundle\Entity\Gouvernorat',
            'cascade_validation' => true,
        ));
    }

    public function getName()
    {
        return 'gouvernorat';
    }
}

?>