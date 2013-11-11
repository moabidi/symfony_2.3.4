<?php

namespace Immobilier\ManagerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class AnnonceType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder->add(  'categpry', 'entity', array(
                        'class'   => 'Immobilier\ManagerBundle\Entity\Category',
                        'property'  => 'name',
                    ))
                ->add(  'nature', 'entity', array(
                    'class'   => 'Immobilier\ManagerBundle\Entity\Nature',
                    'property'  => 'name',
                    ))
                /*->add(  'idType', 'entity', array(
                        'class'   => 'Immobilier\ManagerBundle\Entity\Type',
                        'property'  => 'name',
                    ))*/
                ->add(  'idPays', 'entity', array(
                        'class'   => 'Immobilier\ManagerBundle\Entity\Pays',
                        'property'  => 'name',
                    ))
                ->add('surface')
                ->add('prix');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'Immobilier\ManagerBundle\Entity\Annonce',
            'cascade_validation' => false
        ));
    }


    public function getName()
    {
        return 'annonce';

    }

}

?>