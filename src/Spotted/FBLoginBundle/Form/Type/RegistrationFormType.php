<?php
namespace Spotted\FBLoginBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('firstname');
        $builder->add('lastname');
        $builder->add('gender');
        $builder->add('gender', 'choice', array(
            'choices'   => array('female' => 'Weiblich', 'male' => 'Männlich'),
            'required'  => true,
            'expanded' => true,
            'multiple' => false,
        ));
    }

    public function getName()
    {
        return 'fbloginbundle_user_registration';
    }
}
