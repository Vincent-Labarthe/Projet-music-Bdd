<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Style;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'title',
            TextType::class,
            [
                "label" => "Titre "
            ]
        );

        $builder->add(
            'date',
            DateType::class,
            [
                "label" => "date de sortie",
                'years' => range(date('Y')-100, date('Y'))
            ]
        );
        $builder->add(
            'styles',
            EntityType::class,
            [
                'class' => Style::class,
                "choice_label" => "label",
                "multiple"=>true,
                "expanded"=>true
            ]
        );

        $builder->add(
            'save',
            SubmitType::class,
            [
                "label" => "Ajouter"
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
