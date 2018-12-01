<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("date", DateType::class, array(
                'label'     => 'Date'
            ))
            ->add("title", TextType::class, array(
                'label'     =>  'Title',
                'attr'      => array(
                    'class' => 'form-control'
                )
            ))
            ->add("description", TextareaType::class, array(
                'label'     => 'Description',
                'attr'      => array(
                    'class' => 'form-control',
                    'rows'   => '5'
                )
            ))
            ->add("adress", TextType::class, array(
                'label'     => 'Adress',
                'attr'      => array(
                    'class' => 'form-control'
                )
            ))
            ->add("price", IntegerType::class, array(
                'label'     => 'Price',
                'attr'      => array(
                    'class' => 'form-control'
                )
            ))
            ->add("url", TextType::class, array(
                'label'     => 'URL for buy',
                'attr'      => array(
                    'class' => 'form-control'
                )
            ));
    }
}