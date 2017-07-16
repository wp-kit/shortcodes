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