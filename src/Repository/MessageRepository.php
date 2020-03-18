<?php
declare(strict_types=1);

namespace MonsieurBiz\SyliusAlertMessagePlugin\Repository;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Channel\Model\ChannelInterface;

final class MessageRepository extends EntityRepository implements MessageRepositoryInterface
{

    /**
     * @param ChannelInterface $channel
     * @param string $localeCode
     *
     * @return mixed
     * @throws \Exception
     */
    public function getActiveMessagesForChannelAndLocale(ChannelInterface $channel, string $localeCode)
    {
        $now = new \DateTime('now');
        $qb = $this->createQueryBuilder('o');
        $qb
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->where('o.enabled = true')
            ->andWhere('o.fromDate <= :now OR o.fromDate IS NULL')
            ->andWhere('o.toDate >= :now OR o.toDate IS NULL')
            ->andWhere(':channel MEMBER OF o.channels')
            ->setParameter('locale', $localeCode)
            ->setParameter('now', $now)
            ->setParameter('channel', $channel)
        ;
        return $qb->getQuery()->getResult();
    }


}
