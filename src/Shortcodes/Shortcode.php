<?php
    
    namespace WPKit\Shortcodes;

	class Shortcode {   	

		/**
	     * The shortcode tag
	     *
	     * @var string
	     */
        var $tag = '';
        
        /**
	     * The attributes of the shortcode
	     *
	     * @var array
	     */
        var $atts = array();
		
		/**
	     * Render to shortocde and return output
	     *
	     * @param array $atts
	     * @param string $content
	     * @return string \Illuminate\View\View
		 */
		public function render( $atts = array(), $content = '' ) {
    		
    		$atts = $this->filterAtts( shortcode_atts( $this->getDefaultAtts(), $atts, $this->tag ) );
    		
    		if( $content ) {
        		
        		$atts['content'] = do_shortcode($content);
        		
    		}
    		
    		return view('shortcodes' . DS . $this->getFilename(), $atts);
    		
		}
		
		/**
	     * Get filename for the shortcode
	     *
	     * @return string
		 */
		protected function getFilename() {
    		
    		return $this->tag;
    		
		}
		
		/**
	     * Filter the shortcode attributes
	     *
	     * @param array $atts
	     * @return array
		 */
		protected function filterAtts( $atts = array() ) {
    		
    		return $atts;
    		
		}
		
		/**
	     * Get default attributes for the shortcode
	     *
	     * @return array
		 */
		protected function getDefaultAtts() {
    		
    		return $this->atts;
    		
		}
    	
    }
