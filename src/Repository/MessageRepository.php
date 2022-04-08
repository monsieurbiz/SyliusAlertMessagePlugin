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

use DateTime;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Channel\Model\ChannelInterface;

final class MessageRepository extends EntityRepository implements MessageRepositoryInterface
{
    /**
     * @throws \Exception
     *
     * @return mixed
     */
    public function getActiveMessagesForChannelAndLocale(ChannelInterface $channel, string $localeCode)
    {
        $now = new DateTime('now');
        $queryBuilder = $this->createQueryBuilder('o');
        $queryBuilder
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->where('o.enabled = true')
            ->andWhere('o.fromDate <= :now OR o.fromDate IS NULL')
            ->andWhere('o.toDate >= :now OR o.toDate IS NULL')
            ->andWhere(':channel MEMBER OF o.channels')
            ->setParameter('locale', $localeCode)
            ->setParameter('now', $now)
            ->setParameter('channel', $channel)
        ;

        return $queryBuilder->getQuery()->getResult();
    }
}
