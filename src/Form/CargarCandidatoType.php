<?php

namespace App\Form;

use App\Entity\Candidato;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CargarCandidatoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'label' => 'Nombre del candidato',
                'help' => 'Ingrese el nombre del candidato',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('documento', IntegerType::class, [
                'label' => 'Documento de identidad',
                'help' => 'Ingrese el número de documento de identidad del candidato',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('eslogan', TextType::class, [
                'label' => 'Eslogan',
                'help' => 'Ingrese el eslogan del candidato',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('imagen', FileType::class, [
                'label' => 'Imagen del candidato',
                'help' => 'Seleccione la imagen del candidato',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('Guardar', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidato::class,
        ]);
    }
}
