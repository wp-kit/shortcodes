<?php
	
	namespace Theme\Shortcodes;
    
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