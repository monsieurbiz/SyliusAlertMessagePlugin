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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;

class Message implements MessageInterface
{
    use TimestampableTrait;
    use ToggleableTrait;
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;

        getTranslation as private doGetTranslation;
    }

    protected ?int $id = null;

    protected bool $customersOnly = false;

    protected ?string $name = null;

    protected ?string $description = null;

    /** @var Collection<int, ChannelInterface> */
    protected Collection $channels;

    protected ?string $templateHtml = null;

    protected ?DateTimeInterface $fromDate = null;

    protected ?DateTimeInterface $toDate = null;

    /**
     * Message constructor.
     */
    public function __construct()
    {
        $this->initializeTranslationsCollection();
        $this->channels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isCustomersOnly(): bool
    {
        return $this->customersOnly;
    }

    public function setCustomersOnly(bool $customersOnly): void
    {
        $this->customersOnly = $customersOnly;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getTemplateHtml(): ?string
    {
        return $this->templateHtml;
    }

    public function setTemplateHtml(?string $templateHtml): void
    {
        $this->templateHtml = $templateHtml;
    }

    /**
     * @return Collection<int, ChannelInterface>
     */
    public function getChannels(): Collection
    {
        return $this->channels;
    }

    public function addChannel(ChannelInterface $channel): void
    {
        $this->channels->add($channel);
    }

    public function removeChannel(ChannelInterface $channel): void
    {
        $this->channels->removeElement($channel);
    }

    public function getFromDate(): ?DateTimeInterface
    {
        return $this->fromDate;
    }

    public function setFromDate(?DateTimeInterface $fromDate): void
    {
        $this->fromDate = $fromDate;
    }

    public function getToDate(): ?DateTimeInterface
    {
        return $this->toDate;
    }

    public function setToDate(?DateTimeInterface $toDate): void
    {
        $this->toDate = $toDate;
    }

    public function getTitle(): ?string
    {
        /** @var MessageTranslation $translation */
        $translation = $this->doGetTranslation();

        return $translation->getTitle();
    }

    public function getMessage(): ?string
    {
        /** @var MessageTranslation $translation */
        $translation = $this->doGetTranslation();

        return $translation->getMessage();
    }

    /**
     * @inheritDoc
     */
    protected function createTranslation(): MessageTranslation
    {
        return new MessageTranslation();
    }
}
