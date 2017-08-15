# WPKit Shortcodes

This is a Wordpress PHP Component that handles Shortcodes.

This PHP Component was built to run within an Illuminate Container so is perfect for frameworks such as Themosis.

Often, Wordpress developers want an OOP approach to Shortcodes, this is exactly what this repo delivers.

## Installation

If you're using Themosis, install via composer in the Themosis route folder, otherwise install in your theme folder:

```php
composer require "wp-kit/shortcodes"
```

## Setup

### Add Service Provider

**Within Themosis Theme**

Just register the service provider and facade in the providers config and theme config:

```php
//inside themosis-theme/resources/config/providers.config.php

return [
    WPKit\Shortcodes\ShortcodeServiceProvider::class
];
```

**Within functions.php**

If you are just using this component standalone then add the following the functions.php

```php
// within functions.php

// make sure composer has been installed
if( ! file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	
	wp_die('Composer has not been installed, try running composer', 'Dependancy Error');
	
}

// Use composer to load the autoloader.
require __DIR__ . '/vendor/autoload.php';

$container = new Illuminate\Container\Container(); // create new app container

$provider = new WPKit\Shortcodes\ShortcodeServiceProvider($container); // inject into service provider

$provider->register(); //register service provider
```

### Add PRS4 Class Reference (Themosis Only)

Just add the following line to ```resources/config/loading.config.php``` in the themosis them folder:

```php
'Theme\\Shortcodes\\' => themosis_path('theme.resources').'shortcodes',
```

### Add Config File

The recommended method of installing config files for WPKit Components is via ```wp-kit/vendor-publish``` command.

First, [install WP CLI](http://wp-cli.org/), and then install the package via:

```wp package install wp-kit/vendor-publish```

Once installed you can run:

```wp kit vendor:publish```

For more information, please visit [wp-kit/vendor-publish](https://github.com/wp-kit/vendor-publish).

Alternatively, you can place the [config file(s)](config) in your ```theme/resources/config``` directory manually.

## Usage

```wp-kit\shortcodes``` comes with a class [```WPKit\Shortcodes\Shortcode```](src/Shortcodes/Shortcode.php) which can be extended by your own shortcode classes which should be added inside ```resources/shortcodes``` within the namespace ```Theme\Shortcodes```. 

[Here is an example shortcode class](shortcodes/Test.php).

## Requirements

Wordpress 4+

PHP 5.6+

## License

WPKit Shortcodes is open-sourced software licensed under the MIT License.
