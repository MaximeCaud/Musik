<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Category;
use AppBundle\Entity\News;
use Doctrine\ORM\EntityRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class MediaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name", TextType::class, array(
                'label'         =>  'Title',
                'attr'          =>  array(
                    'class'     =>  'form-control'
                )
            ))
            ->add("category", EntityType::class, array(
                'class'         => Category::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('c')
                        ->where('c.type = :type')
                        ->setParameter('type', "Media");
                },
                'choice_label'  => 'name',
                'attr'          =>  array(
                    'class'     =>  'form-control'
                )
            ))
            ->add("url", TextType::class, array(
               'label'          => 'URL',
                'attr'          => array(
                    'class'     => 'form-control'
                )
            ));

    }
}