<?php
namespace DefaultBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
class UsersType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,['attr' => array(
                'placeholder' => 'Адрес электронной почты',
                'label' => 'E-mail'
            )
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['attr' => array(
                    'placeholder' => 'Пароль',
                ),'label' => 'Пароль'],
                'second_options' => ['attr' => array(
                    'placeholder' => 'Повторите пароль',
                ),'label' => 'Повторите пароль'],
            ])
            ->add('login', TextType::class, ['attr' => array(
                'placeholder' => 'Логин',
            ),
                'label' => 'Логин'

            ])
            ->add('name', TextType::class, ['attr' => array(
                'placeholder' => 'Имя',
            ),
                'label' => 'Имя'
            ])
            ->add('secondName', TextType::class, ['attr' => array(
                'placeholder' => 'Фамилия',
            ),
                'label' =>'Фамилия'
            ])
            ->add('phoneNumber',NumberType::class,['attr' => array(
                'placeholder' => 'Мобильный номер',
            ),
                'label' => 'Телефон'
            ])

        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DefaultBundle\Entity\Users'
        ));
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'defaultbundle_users';
    }
}