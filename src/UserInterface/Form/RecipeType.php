<?php

namespace App\UserInterface\Form;

use App\Domain\DishType;
use App\Domain\Recipe;
use App\Infrastructure\Repository\DishTypeRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('diet_type')
            ->add('serving')
            ->add('prep_time')
            ->add('cook_time')
            ->add('instructions')
            ->add('image_url')
            ->add('season')
            ->add('dishType', EntityType::class, [
                'class' => DishType::class,
                'query_builder' => function (DishTypeRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('d')
                        ->orderBy('d.name', 'ASC');
                },
                'choice_label' => function (DishType $dishType) {
                    return $dishType->getId() . $dishType->getName();
                }]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
