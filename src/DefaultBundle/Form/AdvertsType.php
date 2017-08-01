<?php

namespace DefaultBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AdvertsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class, [
                "label" => "Заголовок",
                'attr'          => array(
                    'class' => 'form-control'
                )
            ])
            ->add('district',TextType::class,[
            "label" => "Район"
            ])
            ->add('adress',TextType::class,[
                "label" => "Адрес"
            ])
            ->add('discription',TextareaType::class,[
            "label" => "Описание"
            ])
            ->add('roomCount', NumberType::class,[
                "label" => "Количество комнат"
            ])
            ->add('floor', NumberType::class,[
                "label" => "Этаж"
            ])
            ->add('pricePerMonth',NumberType::class,[
                "label" => "Цена за месяц"
            ])
            ->add('photoFile', FileType::class, [
                                "label" => "Иконка для объявления",
                                "mapped" => false
            ])
            ->add('dateOfRenting', DateTimeType::class, array(
                'placeholder' => array(
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                ),

            ))
        ;

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DefaultBundle\Entity\Adverts'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'defaultbundle_adverts';
    }


}
