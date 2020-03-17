<?php
declare(strict_types=1);

namespace MonsieurBiz\SyliusAlertMessagePlugin\Entity;

use Sylius\Component\Resource\Model\AbstractTranslation;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="mbiz_alert_message_translation")
 */
class MessageTranslation extends AbstractTranslation implements ResourceInterface
{

    /**
     * @var int|null
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    private $title;

    /**
     * @var string|null
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

}
