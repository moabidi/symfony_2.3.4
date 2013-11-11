<?php
/**
 * Created by JetBrains PhpStorm.
 * User: abidi
 * Date: 10/11/13
 * Time: 12:49
 * To change this template use File | Settings | File Templates.
 */

namespace Immobilier\ManagerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder->add('name');

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Immobilier\ManagerBundle\Entity\Type',
            'cascade_validation' => false
        ));
    }

    public function getName()
    {
        return 'type';
    }
}