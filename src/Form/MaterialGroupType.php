<?php

namespace App\Form;

use App\Entity\Material;
use App\Entity\MaterialGroup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterialGroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('root')
            ->add('parent')
            ->add('materials', CollectionType::class,[
                'entry_type' => MaterialType::class,
                'allow_add' => true,
                'allow_delete' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MaterialGroup::class,
        ]);
    }
}
