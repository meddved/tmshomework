<?php
/**
 * Created by PhpStorm.
 * User: nebojsam
 * Date: 04/08/17
 * Time: 17:16
 */

namespace TMSHomeworkBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PurchaseEntryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customer_name', TextType::class)
            ->add('product', EntityType::class, [
                'class' => 'TMSHomeworkBundle\Entity\Product',
                'choice_label' => 'name',
            ])
            ->add('quantity', NumberType::class)
            ->add('discount', NumberType::class)
            ->add('total', NumberType::class)
            ->add('purchaseDate', DateTimeType::class, [
                    'date_widget' => 'single_text',
                    'format' => 'dd.mm.YYYY'
                ]
            )
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'TMSHomeworkBundle\Entity\Purchase',
            'allow_extra_fields' => true
        ]);
    }

    public function getName()
    {
        return 'purchase';
    }
}
