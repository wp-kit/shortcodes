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

## Using Shortcode Class

WPKit Shortcodes comes with an extendable class as shown below:

```php

namespace App\Shortcodes;
    
use WPKit\Shortcodes\Shortcode;

class Test extends Shortcode {

	var $tag = 'test';
	var $atts = [
		'text' => 'foo',
		'icon' => 'icon.png',
		'message' => 'Hey!'
	];
    
    	public function render( $atts = array(), $content = '' ) {
    		
		$atts = $this->filterAtts( shortcode_atts( $this->getDefaultAtts(), $atts, $this->base ) );

		if( $content ) {

		$atts['content'] = wpautop( do_shortcode($content) );

		}

		return view('shortcodes' . DS . $this->getFilename(), $atts);
		
	}
		
	protected function getFilename() {
		
		return 'tests' . DS . $this->tag;
		
	}
	
	protected function filterAtts( $atts = array() ) {

    		$atts['icon'] = get_stylesheet_directory_uri() . '/images/' . $atts['icon']
		
		return $atts;
		
	}
		
	protected function getDefaultAtts() {

		if( is_user_logged_in() ) {

			global $current_user;
	
			$this->atts['message'] = 'Hey ' . $current_user->first_name;

		}
		
		return $this->atts;
		
	}
    
}


```

## Config

The recommended method of installing config files for WPKit Components is via ```wp-kit/vendor-publish``` command.

First, [install WP CLI](http://wp-cli.org/), and then install the package via:

```wp package install wp-kit/vendor-publish```

Once installed you can run:

```wp kit vendor:publish```

For more information, please visit [wp-kit/vendor-publish](https://github.com/wp-kit/vendor-publish).

Alternatively, you can place the [config file(s)](config) in your ```theme/resources/config``` directory manually.

## Requirements

Wordpress 4+

PHP 5.6+

## License

WPKit Shortcodes is open-sourced software licensed under the MIT License.
