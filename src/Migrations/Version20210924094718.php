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

namespace MonsieurBiz\SyliusAlertMessagePlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210924094718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mbiz_alert_message (id INT AUTO_INCREMENT NOT NULL, enabled TINYINT(1) DEFAULT \'1\' NOT NULL, customers_only TINYINT(1) DEFAULT \'0\' NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, template_html LONGTEXT DEFAULT NULL, from_date DATETIME DEFAULT NULL, to_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mbiz_alert_message_channels (message_id INT NOT NULL, channel_id INT NOT NULL, INDEX IDX_9AA55A51537A1329 (message_id), INDEX IDX_9AA55A5172F5A1AA (channel_id), PRIMARY KEY(message_id, channel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mbiz_alert_message_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, message LONGTEXT NOT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_88BE24892C2AC5D3 (translatable_id), UNIQUE INDEX mbiz_alert_message_translation_uniq_trans (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mbiz_alert_message_channels ADD CONSTRAINT FK_9AA55A51537A1329 FOREIGN KEY (message_id) REFERENCES mbiz_alert_message (id)');
        $this->addSql('ALTER TABLE mbiz_alert_message_channels ADD CONSTRAINT FK_9AA55A5172F5A1AA FOREIGN KEY (channel_id) REFERENCES sylius_channel (id)');
        $this->addSql('ALTER TABLE mbiz_alert_message_translation ADD CONSTRAINT FK_88BE24892C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES mbiz_alert_message (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mbiz_alert_message_channels DROP FOREIGN KEY FK_9AA55A51537A1329');
        $this->addSql('ALTER TABLE mbiz_alert_message_translation DROP FOREIGN KEY FK_88BE24892C2AC5D3');
        $this->addSql('DROP TABLE mbiz_alert_message');
        $this->addSql('DROP TABLE mbiz_alert_message_channels');
        $this->addSql('DROP TABLE mbiz_alert_message_translation');
    }
}
