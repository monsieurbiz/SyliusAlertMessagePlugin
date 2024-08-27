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

namespace MonsieurBiz\SyliusAlertMessagePlugin\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Gedmo\Timestampable\Timestampable;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

interface MessageInterface extends ResourceInterface, TimestampableInterface, ToggleableInterface, TranslatableInterface, Timestampable
{
    public function isCustomersOnly(): bool;

    public function setCustomersOnly(bool $customersOnly): void;

    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    public function getTemplateHtml(): ?string;

    public function setTemplateHtml(?string $templateHtml): void;

    /**
     * @return Collection<int, ChannelInterface>
     */
    public function getChannels(): Collection;

    public function addChannel(ChannelInterface $channel): void;

    public function removeChannel(ChannelInterface $channel): void;

    public function getFromDate(): ?DateTimeInterface;

    public function setFromDate(?DateTimeInterface $fromDate): void;

    public function getToDate(): ?DateTimeInterface;

    public function setToDate(?DateTimeInterface $toDate): void;

    public function getTitle(): ?string;

    public function getMessage(): ?string;
}
