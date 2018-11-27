<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, ['label' => 'Titre'])
            ->add('category', EntityType::class, [
                'class' => category::class,
                'choice_label' => 'title'], null, ['label' => 'Catégorie'])
            ->add('content', null, ['label' => 'Contenu'])
            ->add('imageFile', FileType::class, [
                'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
            'translation_domain' => 'forms'
        ]);
    }
}
