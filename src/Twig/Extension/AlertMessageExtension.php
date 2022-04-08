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

namespace MonsieurBiz\SyliusAlertMessagePlugin\Twig\Extension;

use MonsieurBiz\SyliusAlertMessagePlugin\Helper\MessageHelper;
use Twig\Extension\AbstractExtension;
use Twig\Extension\ExtensionInterface;
use Twig\TwigFunction;

class AlertMessageExtension extends AbstractExtension implements ExtensionInterface
{
    private MessageHelper $messageHelper;

    public function __construct(MessageHelper $messageHelper)
    {
        $this->messageHelper = $messageHelper;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('monsieurbiz_alert_messages', [$this->messageHelper, 'getMessages']),
            new TwigFunction('monsieurbiz_can_display_alert_message', [$this->messageHelper, 'canDisplayMessage']),
            new TwigFunction('monsieurbiz_format_alert_message', [$this->messageHelper, 'formatMessageWithTemplate']),
        ];
    }
}
