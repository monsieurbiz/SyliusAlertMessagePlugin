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

namespace MonsieurBiz\SyliusAlertMessagePlugin\Listener;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function addAdminMenuItem(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
        $configurationChild = $menu->getChild('configuration');
        if (null !== $configurationChild) {
            $configurationChild
                    ->addChild('mbiz-alert-message', ['route' => 'monsieurbiz_alert_message_admin_message_index'])
                    ->setLabel('monsieurbiz_alert_message.ui.messages')
                    ->setLabelAttribute('icon', 'podcast')
            ;
        }
    }
}
