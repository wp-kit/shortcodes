# WPKit Shortcodes

This is a Wordpress PHP Component that handles Shortcodes.

This PHP Component was built to run within an Illuminate Container so is perfect for frameworks such as Themosis.

Often, Wordpress developers want an OOP approach to Shortcodes, this is exactly what this repo delivers.

## Installation

If you're using Themosis, install via composer in the Themosis route folder, otherwise install in your theme folder:

```php
composer require "wp-kit/shortcodes"
```

## Registering Service Provider

**Within Themosis Theme**

Just register the service provider and facade in the providers config and theme config:

```php
//inside themosis-theme/resources/config/providers.config.php

return [
    WPKit\Shortcodes\ShortcodesServiceProvider::class
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

$provider = new WPKit\Shortcodes\ShortcodesServiceProvider($container); // inject into service provider

$provider->register(); //register service provider
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

If you are using Themosis add the following to resources/config/shortcodes.config.php, if you are not then load this configuration into you Container within config.shortcodes.

```php

return [

    /*
    |--------------------------------------------------------------------------
    | Shortcodes
    |--------------------------------------------------------------------------
    |
    | Tell the Service Provider which Shortcodes to instantiate
    |
    */

    'shortcodes' => [
        App\Shortcodes\Test::class
    ]
     
];

```

## Requirements

Wordpress 4+

PHP 5.6+

## License

WPKit Shortcodes is open-sourced software licensed under the MIT License.
