<?php

namespace Apruvd\V4\Responses;
use Httpful\Response;

/**
 * Class APICallback Base class for API response hydration
 * @package Apruvd\V4\Responses
 */
class APICallback{

    /**
     * APICallback constructor.
     * @param array|Object $props
     */
    public function __construct($props = [])
    {
        if(!empty($props) && (is_array($props) || is_object($props))){
            foreach($props as $prop => $value){
                $this->{$prop} = $value;
            }
        }
    }
}