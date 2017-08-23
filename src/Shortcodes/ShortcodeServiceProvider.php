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
		    
		    $config = $this->app['config.factory']->get('shortcodes');
		    
		    foreach( $config['shortcodes'] as $tag => $shortcode ) {
			    
			    add_shortcode( $tag, function($atts, $content) use($shortcode) {
				    
				    $shortcode = $this->app->make($shortcode);
		     
			    	return $this->app->call( [$shortcode, 'render'], $atts, $content );
			        
			    } );
			    
		    }
	        
	    }
	    
	}
