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
            ),
                'label' => false
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['attr' => array(
                    'placeholder' => 'Пароль',
                ),'label' => false],
                'second_options' => ['attr' => array(
                    'placeholder' => 'Повторите пароль',
                ),'label' => false],
            ])
            /*->add('photo', FileType::class, [
                "label" => "Фото",
                "required" => false,
                "mapped" => false
            ])*/
            ->add('login', TextType::class, ['attr' => array(
                'placeholder' => 'Логин',
            ),
                'label' => false
            ])
            ->add('name', TextType::class, ['attr' => array(
                'placeholder' => 'Имя',
            ),
                'label' => false
            ])
            ->add('secondName', TextType::class, ['attr' => array(
                'placeholder' => 'Фамилия',
            ),
                'label' => false
            ])
            ->add('phoneNumber',NumberType::class,['attr' => array(
                'placeholder' => 'Мобильный номер',
            ),
                'label' => false
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