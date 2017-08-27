# wp-kit/shortcodes

This is a wp-kit component that handles shortcodes.

This component was built to run within an [```Illuminate\Container\Container```](https://github.com/illuminate/container/blob/master/Container.php) so is perfect for frameworks such as [```Themosis```](http://framework.themosis.com/), [```Assely```](https://assely.org/) and [```wp-kit/theme```](https://github.com/wp-kit/theme).

Often, WordPress developers want an [```OOP```](https://en.wikipedia.org/wiki/Object-oriented_programming) approach to shortcodes, this is exactly what this repo delivers.

## Installation

If you're using ```Themosis```, install via [```Composer```](https://getcomposer.org/) in the root of your ```Themosis``` installation, otherwise install in your ```Composer``` driven theme folder:

```php
composer require "wp-kit/shortcodes"
```

## Setup

### Add Service Provider

Just register the service provider and facade in the providers config and theme config:

```php
//inside themosis-theme/resources/config/providers.config.php

return [
    WPKit\Shortcodes\ShortcodeServiceProvider::class
];
```

### Add PRS4 Class Reference (Themosis Only)

Just add the following line to ```resources/config/loading.config.php``` in the ```Themosis``` theme folder:

```php
'Theme\\Shortcodes\\' => themosis_path('theme.resources').'shortcodes',
```

### Add Config & View File

The recommended method of installing config files for ```wp-kit``` components is via ```wp-kit/vendor-publish``` command.

First, [install WP CLI](http://wp-cli.org/), and then install the package via:

```wp package install wp-kit/vendor-publish```

Once installed you can run:

```wp kit vendor:publish```

For more information, please visit [wp-kit/vendor-publish](https://github.com/wp-kit/vendor-publish).

Alternatively, you can place the [config file(s)](config), [shortcode file(s)](shortcodes) and [view file(s)](views) in your ```theme/resources/config```, ```theme/resources/shortcodes``` and ```theme/resources/views``` directories manually.

## Usage

### Adding Classes

```wp-kit\shortcodes``` comes with a class [```WPKit\Shortcodes\Shortcode```](src/Shortcodes/Shortcode.php) which can be extended by your own shortcode classes which should be added inside ```resources/shortcodes``` within the namespace ```Theme\Shortcodes```. 

[Here is an example shortcode class](shortcodes/Test.php).

### Adding Views

When you add a shortcode class, be sure to add a template view file within ```resources\views\shortcodes``` with the same name as the ```$tag``` you have set in the shortcode class.

You may use whatever either ```twig``` or ```php``` file types. We always recommend [```twig```](https://twig.symfony.com/).

[Here is an example view files](views/shortcodes/tests/test.twig).

## Requirements

Wordpress 4+

PHP 5.6+

## License

wp-kit/shortcodes is open-sourced software licensed under the MIT License.
