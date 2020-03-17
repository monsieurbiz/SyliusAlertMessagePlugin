<p align="center">
    <a href="https://monsieurbiz.com" target="_blank">
        <img src="https://monsieurbiz.com/logo.png" width="250px" />
    </a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="https://sylius.com" target="_blank">
        <img src="https://demo.sylius.com/assets/shop/img/logo.png" width="200px" />
    </a>
</p>

<h1 align="center">Alert Message</h1>

[![Alert Message Plugin license](https://img.shields.io/github/license/monsieurbiz/SyliusAlertMessagePlugin)](https://github.com/monsieurbiz/SyliusAlertMessagePlugin/blob/master/LICENSE.txt)
<!--[![Build Status](https://travis-ci.com/monsieurbiz/SyliusAlertMessagePlugin.svg?branch=master)](https://travis-ci.com/monsieurbiz/SyliusAlertMessagePlugin)-->
<!--[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/monsieurbiz/SyliusAlertMessagePlugin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/monsieurbiz/SyliusAlertMessagePlugin/?branch=master)-->

This plugins allows you to add simple messages on your shop.  
The messages can be different for logged-in customers.

The message is displayed just after the opening `body`. You can change the HTML template directly in the admin panel.  
By default it'll use the Semantic UI classes.

![](screenshot.png) 

## Installation

**Beware!**

> This installation instruction assumes that you're using Symfony Flex.

1. Require the plugin using composer

    ```bash
    composer require monsieurbiz/sylius-alert-message-plugin
    ```

2. Generate & Run Doctrine migrations

```
./bin/console doctrine:migration:diff
./bin/console doctrine:migration:migrate
```

## How it works

You just have to go in the Alert Messages section in your admin panel and add new message(s)! 

## Testing

See [TESTING.md](TESTING.md).

## Contributing

You can open an issue or a Pull Request if you want! 😘  
Thank you!