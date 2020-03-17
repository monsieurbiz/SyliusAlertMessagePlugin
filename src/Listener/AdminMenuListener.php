<?php
declare(strict_types=1);

namespace MonsieurBiz\SyliusAlertMessagePlugin\Listener;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{

    public function addAdminMenuItem(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
        $menu
            ->getChild('configuration')
                ->addChild('mbiz-alert-message', ['route' => 'monsieurbiz_alert_message_admin_message_index'])
                    ->setLabel('monsieurbiz_alert_message.ui.messages')
                    ->setLabelAttribute('icon', 'podcast')
        ;

    }

}
