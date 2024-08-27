<?php

/*
 * This file is part of Monsieur Biz' Alert Message plugin for Sylius.
 *
 * (c) Monsieur Biz <sylius@monsieurbiz.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace MonsieurBiz\SyliusAlertMessagePlugin\Fixture\Factory;

use DateTime;
use MonsieurBiz\SyliusAlertMessagePlugin\Entity\MessageInterface;
use MonsieurBiz\SyliusAlertMessagePlugin\Entity\MessageTranslationInterface;
use Sylius\Bundle\CoreBundle\Fixture\Factory\AbstractExampleFactory;
use Sylius\Bundle\CoreBundle\Fixture\OptionsResolver\LazyOption;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageFixtureFactory extends AbstractExampleFactory implements MessageFixtureFactoryInterface
{
    /**
     * @var FactoryInterface
     */
    private $messageFactory;

    /**
     * @var FactoryInterface
     */
    private $messageTranslationFactory;

    /**
     * @var OptionsResolver
     */
    private $optionsResolver;

    /** @var \Faker\Generator */
    private $faker;

    /** @var RepositoryInterface */
    private $localeRepository;

    /** @var ChannelRepositoryInterface */
    private $channelRepository;

    public function __construct(
        FactoryInterface $messageFactory,
        FactoryInterface $messageTranslationFactory,
        ChannelRepositoryInterface $channelRepository,
        RepositoryInterface $localeRepository
    ) {
        $this->messageFactory = $messageFactory;
        $this->messageTranslationFactory = $messageTranslationFactory;
        $this->channelRepository = $channelRepository;
        $this->localeRepository = $localeRepository;

        $this->faker = \Faker\Factory::create();

        $this->optionsResolver = new OptionsResolver();
        $this->configureOptions($this->optionsResolver);
    }

    /**
     * @inheritdoc
     */
    public function create(array $options = []): MessageInterface
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var MessageInterface $message */
        $message = $this->messageFactory->createNew();
        $message->setEnabled($options['enabled'] ?? false);
        $message->setCustomersOnly($options['customers_only'] ?? false);
        $message->setName($options['name']);
        $message->setDescription($options['description']);
        $message->setTemplateHtml($options['html_template']);
        $message->setFromDate(!empty($options['from']) ? new DateTime($options['from']) : null);
        $message->setToDate(!empty($options['to']) ? new DateTime($options['to']) : null);

        foreach ($options['channels'] as $channel) {
            $message->addChannel($channel);
        }

        $this->createTranslations($message, $options);

        return $message;
    }

    private function createTranslations(MessageInterface $message, array $options): void
    {
        foreach ($options['translations'] as $localeCode => $translation) {
            /** @var MessageTranslationInterface $messageTranslation */
            $messageTranslation = $this->messageTranslationFactory->createNew();
            $messageTranslation->setLocale($localeCode);
            $messageTranslation->setTitle($translation['title']);
            $messageTranslation->setMessage($translation['message']);

            $message->addTranslation($messageTranslation);
        }
    }

    /**
     * @inheritdoc
     */
    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('enabled', function (Options $options): bool {
                return $this->faker->boolean(80);
            })
            ->setDefault('customers_only', function (Options $options): bool {
                return $this->faker->boolean(10);
            })
            ->setDefault('name', function (Options $options): string {
                return $this->faker->sentence(2, true);
            })
            ->setDefault('description', function (Options $options): string {
                return $this->faker->sentence(10, true);
            })
            ->setDefault('html_template', function (Options $options): string {
                return '';
            })
            ->setDefault('from', function (Options $options): string {
                return '';
            })
            ->setDefault('to', function (Options $options): string {
                return '';
            })
            ->setDefault('translations', function (OptionsResolver $translationResolver): void {
                $translationResolver->setDefaults($this->configureDefaultTranslations());
            })
            ->setDefault('channels', LazyOption::all($this->channelRepository))
            ->setAllowedTypes('channels', 'array')
            ->setNormalizer('channels', LazyOption::findBy($this->channelRepository, 'code'))
        ;
    }

    private function configureDefaultTranslations(): array
    {
        $translations = [];
        $locales = $this->localeRepository->findAll();
        /** @var LocaleInterface $locale */
        foreach ($locales as $locale) {
            $title = ucfirst($this->faker->sentence(3, true));
            $translations[$locale->getCode()] = [
                'title' => $title,
                'message' => $this->faker->sentence(10, true),
            ];
        }

        return $translations;
    }
}
