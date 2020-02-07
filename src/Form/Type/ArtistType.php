<?php

namespace App\Form\Type;

use App\Entity\Artist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'artistName',
            TextType::class,
            [
                "label" => "Nom d'artiste"
            ]
        )->add(
            'realName',
            TextType::class,
            [
                "label" => "Nom réel"
            ]
        )->add(
            'birthDate',
            BirthdayType::class,
            [
                "label" => "Date de naissance"
            ]
        )->add(
            'deathDate',
            DateType::class,
            [
                "required" => false,
                "label" => "Date de décès"
            ]
        )->add(
            'gender',
            ChoiceType::class,
            [
                'choices'  => [
                    'Homme' => 'male',
                    'Femme' => 'female'
                ],
                "label" => "Genre"
            ]
        )->add(
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
            'data_class' => Artist::class,
        ]);
    }
}
