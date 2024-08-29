[![Banner of Sylius Alert Message plugin](docs/images/banner.jpg)](https://monsieurbiz.com/agence-web-experte-sylius)

<h1 align="center">Sylius Alert Message</h1>

[![Alert Message Plugin license](https://img.shields.io/github/license/monsieurbiz/SyliusAlertMessagePlugin?public)](https://github.com/monsieurbiz/SyliusAlertMessagePlugin/blob/master/LICENSE.txt)
[![Tests Status](https://img.shields.io/github/actions/workflow/status/monsieurbiz/SyliusAlertMessagePlugin/tests.yaml?branch=master&logo=github)](https://github.com/monsieurbiz/SyliusAlertMessagePlugin/actions?query=workflow%3ATests)
[![Recipe Status](https://img.shields.io/github/actions/workflow/status/monsieurbiz/SyliusAlertMessagePlugin/recipe.yaml?branch=master&label=recipes&logo=github)](https://github.com/monsieurbiz/SyliusAlertMessagePlugin/actions?query=workflow%3ASecurity)
[![Security Status](https://img.shields.io/github/actions/workflow/status/monsieurbiz/SyliusAlertMessagePlugin/security.yaml?branch=master&label=security&logo=github)](https://github.com/monsieurbiz/SyliusAlertMessagePlugin/actions?query=workflow%3ASecurity)


This plugins allows you to add simple messages on your shop.  
The messages can be different for logged-in customers.

The message is displayed just after the opening `body`. You can change the HTML template directly in the admin panel.  
By default it'll use the Semantic UI classes.

![](screenshot.png) 

## Compatibility

| Sylius Version | PHP Version |
|---|---|
| 1.11 | 8.0 - 8.1 |
| 1.12 | 8.1 - 8.2 |
| 1.13 | 8.1 - 8.2 |


## Installation

**Beware!**

> This installation instruction assumes that you're using Symfony Flex.

If you want to use our recipes, you can configure your composer.json by running:

```bash
composer config --no-plugins --json extra.symfony.endpoint '["https://api.github.com/repos/monsieurbiz/symfony-recipes/contents/index.json?ref=flex/master","flex://defaults"]'
```

1. Require the plugin using composer

    ```bash
    composer require monsieurbiz/sylius-alert-message-plugin
    ```

2. Run Doctrine migrations

    ```
    ./bin/console doctrine:migration:migrate
    ```

## How it works

You just have to go in the Alert Messages section in your admin panel and add new message(s)!

## Examples

You could use this plugin to:

- Tell your customer how you are dealing with an epidemic outbreak.
- Make a legal announcement.
- Give all your logged-in customers a very attractive coupon code.

Being able to add a well seen message on your shop can be useful.

## Admin form

![](admin-form.jpg)

## Testing

See [TESTING.md](TESTING.md).

## Contributing

You can open an issue or a Pull Request if you want! 😘    
Thank you!
