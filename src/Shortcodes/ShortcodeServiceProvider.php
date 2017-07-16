<?php
	
	namespace WPKit\Shortcodes;
	
	use WPKit\Integrations\IntegrationServiceProvider;
	
	class ShortcodeServiceProvider extends IntegrationServiceProvider {
		
	    public function startIntegration() {
		    
		    foreach( $this->app['config.factory']->get('shortcodes.shortcodes') as $tag => $shortcode ) {
			    
			    $shortcode = new $shortcode;
			    
			    add_shortcode( $shortcode->tag, function($atts) use($shortcode) {
		     
			    	$this->app->call( [$shortcode, 'render'], compact( 'atts' ) );
			        
			    } );
			    
		    }
	        
	    }
	    
	}
