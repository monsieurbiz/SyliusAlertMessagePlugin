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

namespace MonsieurBiz\SyliusAlertMessagePlugin\Repository;

use Sylius\Component\Channel\Model\ChannelInterface;

interface MessageRepositoryInterface
{
    /**
     * @param ChannelInterface $channel
     * @param string $localeCode
     *
     * @return mixed
     */
    public function getActiveMessagesForChannelAndLocale(ChannelInterface $channel, string $localeCode);
}
