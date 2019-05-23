<?php

namespace Apruvd\V4\Models;

/**
 * Class Product A subset of the CartContent/Transaction model
 * @package Apruvd\V4\Models
 */
class Product extends APIModel{
    /**
     * @var string $unique_id
     */
    public $unique_id = null;
    /**
     * @var string $product_type ENUM outlined in enum_fields property
     */
    public $product_type = null;
    /**
     * @var string $category
     */
    public $category = null;
    /**
     * @var string $name
     */
    public $name = null;
    /**
     * @var string $brand
     */
    public $brand = null;
    /**
     * @var string $is_high_risk
     */
    public $is_high_risk = null;
    /**
     * @var string $url Fully qualified URL
     */
    public $url = null;
    /**
     * @var string $image_url Fully qualified URL
     */
    public $image_url = null;
    /**
     * @var object|array $extra Generic nested object of any structure
     */
    public $extra = null;

    /**
     * @var array $props
     */
    public $props = [
        'unique_id', 'product_type', 'category', 'name', 'brand', 'is_high_risk', 'url', 'image_url', 'extra'
    ];

    /**
     * @var array $string_fields
     */
    public $string_fields = [
        'unique_id', 'category', 'name', 'brand', 'is_high_risk', 'url', 'image_url'
    ];

    /**
     * @var array $enum_fields
     */
    public $enum_fields = [
        'product_type' => ['Physical',' Gift card', 'E-gift card']
    ];
}