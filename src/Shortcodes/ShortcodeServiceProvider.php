<?php
	
	namespace WPKit\Shortcodes;
	
	use WPKit\Integrations\Integration;
	
	class ShortcodeServiceProvider extends Integration {
		
		/**
		* Boot the service provider
		*
		* @return void
		*/
		public function boot() {
			
			$this->publishes([
				__DIR__.'/../../config/shortcodes.config.php' => config_path('shortcodes.config.php')
			], 'config');
			
			$this->publishes([
				__DIR__.'/../../shortcodes/Test.php' => shortcode_path('Test.php')
			], 'shortcodes');
			
			$this->publishes([
				__DIR__.'/../../views/shortcodes/tests/test.twig' => view_path('shortcodes/tests/test.twig')
			], 'views');
			
		}
		
	    public function startIntegration() {
		    
		    foreach( $this->app['config.factory']->get('shortcodes.shortcodes') as $tag => $shortcode ) {
			    
			    $shortcode = new $shortcode;
			    
			    add_shortcode( $shortcode->tag, function($atts) use($shortcode) {
		     
			    	return $this->app->call( [$shortcode, 'render'], compact( 'atts' ) );
			        
			    } );
			    
		    }
	        
	    }
	    
	}
