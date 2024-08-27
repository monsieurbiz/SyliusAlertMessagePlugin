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

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

interface MessageTranslationInterface extends ResourceInterface, TranslationInterface
{
    public function getId(): ?int;

    public function getTitle(): ?string;

    public function setTitle(?string $title): void;

    public function getMessage(): ?string;

    public function setMessage(string $message): void;
}
