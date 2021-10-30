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
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Timestampable;
use Sylius\Component\Channel\Model\Channel;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Resource\Model\TranslatableTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="mbiz_alert_message")
 */
class Message implements ResourceInterface, TimestampableInterface, ToggleableInterface, TranslatableInterface, Timestampable
{
    use TimestampableTrait;
    use ToggleableTrait;
    use TranslatableTrait {
        __construct as private initializeTranslationsCollection;
        getTranslation as private doGetTranslation;
    }

    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default"=true})
     */
    protected $enabled = true;

    /**
     * @var bool
     * @ORM\Column(name="customers_only", type="boolean", options={"default"=false})
     */
    protected $customersOnly = false;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    protected $description;

    /**
     * @var Collection<int, Channel>
     * @ORM\ManyToMany(targetEntity="\Sylius\Component\Channel\Model\Channel")
     * @ORM\JoinTable(
     *     name="mbiz_alert_message_channels",
     *     joinColumns={@ORM\JoinColumn(name="message_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="channel_id", referencedColumnName="id")}
     * )
     */
    private $channels;

    /**
     * @var DateTimeInterface|null
     * @ORM\Column(name="created_at", type="datetime_immutable")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @var DateTimeInterface|null
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;

    /**
     * @var string|null
     * @ORM\Column(name="template_html", type="text", nullable=true)
     */
    private $templateHtml;

    /**
     * @var DateTimeInterface|null
     * @ORM\Column(name="from_date", type="datetime", nullable=true)
     */
    private $fromDate;

    /**
     * @var DateTimeInterface|null
     * @ORM\Column(name="to_date", type="datetime", nullable=true)
     */
    private $toDate;

    /**
     * Message constructor.
     */
    public function __construct()
    {
        $this->initializeTranslationsCollection();
        $this->channels = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isCustomersOnly(): bool
    {
        return $this->customersOnly;
    }

    /**
     * @param bool $customersOnly
     */
    public function setCustomersOnly(bool $customersOnly): void
    {
        $this->customersOnly = $customersOnly;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getTemplateHtml(): ?string
    {
        return $this->templateHtml;
    }

    /**
     * @param string|null $templateHtml
     */
    public function setTemplateHtml(?string $templateHtml): void
    {
        $this->templateHtml = $templateHtml;
    }

    /**
     * @return Collection<int, Channel>
     */
    public function getChannels(): Collection
    {
        return $this->channels;
    }

    /**
     * @param Channel $channel
     */
    public function addChannel(Channel $channel): void
    {
        $this->channels->add($channel);
    }

    /**
     * @param Channel $channel
     */
    public function removeChannel(Channel $channel): void
    {
        $this->channels->removeElement($channel);
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getFromDate(): ?DateTimeInterface
    {
        return $this->fromDate;
    }

    /**
     * @param DateTimeInterface|null $fromDate
     */
    public function setFromDate(?DateTimeInterface $fromDate): void
    {
        $this->fromDate = $fromDate;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getToDate(): ?DateTimeInterface
    {
        return $this->toDate;
    }

    /**
     * @param DateTimeInterface|null $toDate
     */
    public function setToDate(?DateTimeInterface $toDate): void
    {
        $this->toDate = $toDate;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        /** @var MessageTranslation $translation */
        $translation = $this->doGetTranslation();

        return $translation->getTitle();
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        /** @var MessageTranslation $translation */
        $translation = $this->doGetTranslation();

        return $translation->getMessage();
    }

    /**
     * {@inheritDoc}
     */
    protected function createTranslation(): MessageTranslation
    {
        return new MessageTranslation();
    }
}
