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

namespace MonsieurBiz\SyliusAlertMessagePlugin\Helper;

use MonsieurBiz\SyliusAlertMessagePlugin\Entity\Message;
use MonsieurBiz\SyliusAlertMessagePlugin\Repository\MessageRepositoryInterface;
use Sonata\BlockBundle\Model\Block;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Customer\Context\CustomerContextInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;

final class MessageHelper extends Block
{
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
     * MessageHelper constructor.
     */
    public function __construct(
        ChannelContextInterface $channelContext,
        LocaleContextInterface $localeContext,
        CustomerContextInterface $customerContext,
        MessageRepositoryInterface $messageRepository
    ) {
        parent::__construct();
        $this->channelContext = $channelContext;
        $this->localeContext = $localeContext;
        $this->customerContext = $customerContext;
        $this->messageRepository = $messageRepository;
    }

    public function getMessages(): array
    {
        return $this->messageRepository->getActiveMessagesForChannelAndLocale(
            $this->channelContext->getChannel(),
            $this->localeContext->getLocaleCode()
        );
    }

    public function canDisplayMessage(Message $message): bool
    {
        return
            !$message->isCustomersOnly()
            || null !== $this->customerContext->getCustomer();
    }

    public function formatMessageWithTemplate(Message $message): ?string
    {
        $template = (string) $message->getTemplateHtml();
        $template = preg_replace('`{{\s*title\s*}}`i', (string) $message->getTitle(), $template);

        return preg_replace('`{{\s*message\s*}}`i', (string) $message->getMessage(), (string) $template);
    }
}
