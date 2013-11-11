<?php

// src/Acme/TaskBundle/Form/Type/CategoryType.php
namespace Immobilier\ManagerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PaysType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Immobilier\ManagerBundle\Entity\Pays',
        ));
    }

    public function getName()
    {
        return 'pays';
    }
}

?>