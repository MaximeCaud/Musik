<?php

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ContactFormType extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options)
   {
       $builder
           ->add("name", TextType::class, array(
               'label'  =>  'Name',
               'attr'   =>  array(
                   'class'  =>  'form-control'
               )
           ))
           ->add("subject", TextType::class, array(
               'label'  =>  'Subject',
               'attr'   =>  array(
                   'class'  =>  'form-control'
               )
           ))
           ->add("email", EmailType::class, array(
               'label'  =>  'Email',
               'attr'   =>  array(
                   'class'  =>  'form-control'
               )
           ))
           ->add('message', TextareaType::class, array(
               'label'  =>  'Message',
               'attr'   =>  array(
                   'class'  =>  'form-control'
               )
           ))
           ->add('781227', HiddenType::class);
   }
}