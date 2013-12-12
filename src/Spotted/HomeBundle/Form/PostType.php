<?php

namespace Spotted\HomeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Spotted\HomeBundle\Entity\Posttags;
use Spotted\HomeBundle\Entity\Tags;

class PostType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', 'textarea')
			->add('geschlecht', 'choice', array(
					'choices'   => array('m' => 'male', 'f' => 'female'),
					'expanded'=>true,
					'required'  => true,
					))
			->add('location', 'text', [
                'mapped' => false,
            ])
			->add('tags', 'entity', array(
                'class' => 'SpottedHomeBundle:Tags',
                'property' => 'bezeichnung',
				'expanded'=>true,
                'multiple'=>true,
              ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Spotted\HomeBundle\Entity\Post'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'spotted_homebundle_post';
    }
}
