<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Idee;
use Doctrine\ORM\Query\Expr\Select;
use phpDocumentor\Reflection\DocBlock\Description;
use phpDocumentor\Reflection\Types\Object_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormTypeInterface;

class IdeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, array(
           'attr' => array('style' => 'width: 100%')
          ))
            ->add('description', null, array(
                'attr' => array('style' => 'width: 100%')
            ))
            ->add('author', null, array(
                'attr' => array('style' => 'width: 100%')
            ))

            ->add('category', ChoiceType::class)

            ->add('Ajouter', submitType::class, array(
                'attr' => array('class' => 'btn btn-primary btn-sm', 'style' => 'width: 15%')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Idee::class,
        ]);
    }
}
