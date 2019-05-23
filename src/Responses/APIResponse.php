<?php

namespace Apruvd\V4\Responses;

/**
 * Class APIResponse Base class for API response hydration
 * @package Apruvd\V4\Responses
 */
class APIResponse{
    /**
     * APIResponse constructor.
     * @param null|array|object $props
     */
    public function __construct($props = null)
    {
        if(!empty($props) && (is_array($props) || is_object($props))){
            foreach($props as $prop => $value){
                $this->{$prop} = $value;
            }
        }
    }
}