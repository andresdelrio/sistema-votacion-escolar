<?php

namespace App\Form;

use App\Entity\Institucion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class InstitucionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'label' => 'Nombre de la institución'
            ])
            ->add('imagen', FileType::class, [
                'label' => 'Imagen de la institución'
            ])
            ->add('telefono', TelType::class, [
                'label' => 'Teléfono de la institución'
            ])
            ->add('direccion', TextType::class, [
                'label' => 'Dirección de la institución'
            ])
            ->add('sitioweb', UrlType::class, [
                'label' => 'Sitio web de la institución'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Institucion::class,
        ]);
    }
}
