<?php
    
    namespace WPKit\Shortcodes;

	class Shortcode {   	

        var $tag = '';
        var $atts = array();
		
		public function render( $atts = array(), $content = '' ) {
    		
    		$atts = $this->filterAtts( shortcode_atts( $this->getDefaultAtts(), $atts, $this->tag ) );
    		
    		if( $content ) {
        		
        		$atts['content'] = do_shortcode($content);
        		
    		}
    		
    		return view('shortcodes' . DS . $this->getFilename(), $atts);
    		
		}
		
		protected function getFilename() {
    		
    		return $this->tag;
    		
		}
		
		protected function filterAtts( $atts = array() ) {
    		
    		return $atts;
    		
		}
		
		protected function getDefaultAtts() {
    		
    		return $this->atts;
    		
		}
    	
    }
