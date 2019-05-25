<?php

namespace Apruvd\V4\Responses\Nested;

/**
 * Class NestedHydrator
 * @package Apruvd\V4\Responses\Nested
 */
class NestedHydrator{

    /**
     * NestedHydrator constructor.
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