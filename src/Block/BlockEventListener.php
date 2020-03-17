<?php
declare(strict_types=1);

namespace MonsieurBiz\SyliusAlertMessagePlugin\Block;

use MonsieurBiz\SyliusAlertMessagePlugin\Repository\MessageRepositoryInterface;
use Sonata\BlockBundle\Event\BlockEvent;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Customer\Context\CustomerContextInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;

final class BlockEventListener
{
    /** @var string */
    private $template;

    /**
     * @var ChannelContextInterface
     */
    private $channelContext;

    /**
     * @var LocaleContextInterface
     */
    private $localeContext;

    /**
     * @var CustomerContextInterface
     */
    private $customerContext;

    /**
     * @var MessageRepositoryInterface
     */
    private $messageRepository;

    /**
     * BlockEventListener constructor.
     *
     * @param string $template
     * @param ChannelContextInterface $channelContext
     * @param LocaleContextInterface $localeContext
     * @param CustomerContextInterface $customerContext
     * @param MessageRepositoryInterface $messageRepository
     */
    public function __construct(
        string $template,
        ChannelContextInterface $channelContext,
        LocaleContextInterface $localeContext,
        CustomerContextInterface $customerContext,
        MessageRepositoryInterface $messageRepository
    ) {
        $this->template = $template;
        $this->channelContext = $channelContext;
        $this->localeContext = $localeContext;
        $this->customerContext = $customerContext;
        $this->messageRepository = $messageRepository;
    }

    /**
     * @param BlockEvent $event
     */
    public function onBlockEvent(BlockEvent $event): void
    {
        $block = new MessageBlock(
            $this->channelContext,
            $this->localeContext,
            $this->customerContext,
            $this->messageRepository
        );
        $block->setId(uniqid('', true));
        $block->setSettings(array_replace($event->getSettings(), [
            'template' => $this->template,
        ]));
        $block->setType('sonata.block.service.template');

        $event->addBlock($block);
    }

}
