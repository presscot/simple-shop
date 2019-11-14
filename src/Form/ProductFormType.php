<?php
/**
 * Created by PhpStorm.
 * User: pprusek
 * Date: 13.11.19
 * Time: 13:48
 */

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Name',
                    'required' => true
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'label' => 'Description',
                    'required' => true
                ]
            )
            ->add(
                'price',
                NumberType::class,
                [
                    'label' => 'Price',
                    'required' => true,
                ]
            )
            ->add(
                'Add',
                SubmitType::class
            )
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => Product::class,
                'error_bubbling' => true,
                'new' => false
            )
        );
    }
}