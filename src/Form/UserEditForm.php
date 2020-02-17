<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserEditForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("id", HiddenType::class, ['mapped' => false]);
        $builder->add("email", TextType::class);
        $builder->add("password", PasswordType::class);
        $builder->add("roles", ChoiceType::class, [
        "choices" => ['ROLE_ADMINMASTER','ROLE_USER'],
        'multiple' => true,
        'expanded' => true
        ]);
        $builder->add("name", TextType::class);
        $builder->add("last_name", TextType::class);
        $builder->add("age", NumberType::class);
        $builder->add("save", SubmitType::class, ["label" => "Update user"]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
