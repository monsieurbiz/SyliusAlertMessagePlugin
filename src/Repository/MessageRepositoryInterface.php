<?php
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
