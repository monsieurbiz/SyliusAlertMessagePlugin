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

namespace MonsieurBiz\SyliusAlertMessagePlugin\Fixture;

use Doctrine\ORM\EntityManagerInterface;
use MonsieurBiz\SyliusAlertMessagePlugin\Fixture\Factory\MessageFixtureFactoryInterface;
use Sylius\Bundle\CoreBundle\Fixture\AbstractResourceFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class MessageFixture extends AbstractResourceFixture
{
    public function __construct(EntityManagerInterface $messageManager, MessageFixtureFactoryInterface $exampleFactory)
    {
        parent::__construct($messageManager, $exampleFactory);
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'monsieurbiz_alert_message';
    }

    /**
     * @inheritdoc
     */
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        /** @phpstan-ignore-next-line */
        $resourceNode
            ->children()
                ->booleanNode('enabled')->end()
                ->booleanNode('customers_only')->defaultFalse()->end()
                ->arrayNode('channels')
                    ->scalarPrototype()->end()
                ->end()
                ->scalarNode('name')->cannotBeEmpty()->end()
                ->scalarNode('description')->end()
                ->scalarNode('from')->end()
                ->scalarNode('to')->end()
                ->scalarNode('html_template')->end()
                ->arrayNode('translations')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('title')->cannotBeEmpty()->end()
                            ->scalarNode('message')->cannotBeEmpty()->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
