<?php
	
	if (!function_exists('view')) {
	    /**
	     * Helper function to build views.
	     *
	     * @param string $view      The view relative path, name.
	     * @param array  $data      Passed data.
	     * @param array  $mergeData
	     *
	     * @return string
	     */
	    function view($view = null, array $data = [], array $mergeData = [])
	    {
	        $factory = app('view');
	        if (func_num_args() === 0) {
	            return $factory;
	        }
	        return $factory->make($view, $data, $mergeData)->render();
	    }
	}
	
	if( ! function_exists( 'shortcodes_path' ) ) {
		
		function shortcodes_path( $file = '' ) {
			
		    if( function_exists('themosis_path') ) {
			    $root = themosis_path('theme.resources');
		    } else {
			    $root = get_stylesheet_directory() . DS . 'resources';
		    }
		    return $root . ( $path ? DS . $path : '' ) . ltrim( ( $file ? DS . $file : '' ), DS );
			
		}
		
	}
