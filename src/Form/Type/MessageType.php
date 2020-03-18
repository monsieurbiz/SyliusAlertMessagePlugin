<?php
declare(strict_types=1);

namespace MonsieurBiz\SyliusAlertMessagePlugin\Form\Type;

use Sylius\Bundle\ChannelBundle\Form\Type\ChannelChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class MessageType extends AbstractResourceType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('enabled', CheckboxType::class, [
                'required' => false,
                'label' => 'monsieurbiz_alert_message.ui.form.enabled',
            ])
            ->add('customersOnly', CheckboxType::class, [
                'required' => false,
                'label' => 'monsieurbiz_alert_message.ui.form.customers_only',
            ])
            ->add('channels', ChannelChoiceType::class, [
                'required' => false,
                'label' => 'monsieurbiz_alert_message.ui.form.channels',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'monsieurbiz_alert_message.ui.form.name',
            ])
            ->add('description', TextType::class, [
                'required' => false,
                'label' => 'monsieurbiz_alert_message.ui.form.description',
            ])
            ->add('fromDate', DateTimeType::class, [
                'required' => false,
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'label' => 'monsieurbiz_alert_message.ui.form.from',
            ])
            ->add('toDate', DateTimeType::class, [
                'required' => false,
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'label' => 'monsieurbiz_alert_message.ui.form.to',
            ])
            ->add('templateHtml', TextareaType::class, [
                'required' => false,
                'label' => 'monsieurbiz_alert_message.ui.form.template_html__with_hints',
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => MessageTranslationType::class,
                'label' => 'monsieurbiz_alert_message.ui.form.translations',
            ])
        ;
    }
}
