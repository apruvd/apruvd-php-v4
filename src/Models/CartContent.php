<?php

namespace Apruvd\V4\Models;

/**
 * Class CartContent - A product subset of the transaction model.
 * @package Apruvd\V4\Models
 */
class CartContent extends APIModel{
    /**
     * @var Product $product
     */
    public $product = null;
    /**
     * @var integer $quantity
     */
    public $quantity = null;
    /**
     * @var float|double|integer $unit_price
     */
    public $unit_price = null;
    /**
     * @var boolean $is_gift
     */
    public $is_gift = null;
    /**
     * @var string $gift_message
     */
    public $gift_message = null;

    /**
     * @var array $props
     */
    protected $props = [
        'product', 'quantity', 'unit_price', 'gift_message'
    ];

    /**
     * @var array $string_fields
     */
    protected $string_fields = ['gift_message'];

    /**
     * @var array $boolean_fields
     */
    protected $boolean_fields = ['is_gift'];

    /**
     * @var array $number_fields
     */
    protected $number_fields = ['unit_price'];

    /**
     * @var array $integer_fields
     */
    protected $integer_fields = ['quantity'];
}