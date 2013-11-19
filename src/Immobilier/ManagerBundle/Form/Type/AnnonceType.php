<?php

namespace Immobilier\ManagerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Oh\GoogleMapFormTypeBundle\Form\Type\GoogleMapType;
use Immobilier\ManagerBundle\Entity\Pays;
use Immobilier\ManagerBundle\Entity\Type;
use Immobilier\ManagerBundle\Entity\Category;

class AnnonceType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder->add(  'idPays', 'entity', array(
                        'class'   => 'Immobilier\ManagerBundle\Entity\Pays',
                        'property'  => 'name',
                    ))
                ->add(  'idCategory', 'entity', array(
                        'class'   => 'Immobilier\ManagerBundle\Entity\Category',
                        'property'  => 'name',
                    ))
                ->add(  'nature', 'entity', array(
                    'class'   => 'Immobilier\ManagerBundle\Entity\Nature',
                    'property'  => 'name',
                    ))
                ->add(  'idType', 'entity', array(
                        'class'   => 'Immobilier\ManagerBundle\Entity\Type',
                        'property'  => 'name',
                    ))
                ->add(  'photos', 'collection', array(
                        // each item in the array will be an "email" field
                        'type'   => 'file',
                        // these options are passed to each "email" type
                        'options'  => array(
                            'required'  => false,
                            'attr'      => array('class' => 'file-box')

                        ),
                        'allow_add' => true
                    ))
                ->add('surface')
                ->add('prix')
                ->add('description','textarea')
                ->add('latlng', 'oh_google_maps');
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