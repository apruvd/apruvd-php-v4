<?php

namespace Apruvd\V4\Models;

/**
 * Class DiscountCode A subset of the Transaction Model
 * @package Apruvd\V4\Models
 */
class DiscountCode extends APIModel{
    /**
     * @var string $code
     */
    public $code = null;
    /**
     * @var string $description
     */
    public $description = null;
    /**
     * @var float|double|integer $amount
     */
    public $amount = null;
    /**
     * @var string $discount_type
     */
    public $discount_type = null;
    /**
     * @var \DateTime|string $expires YYYY-MM-DD HH:MM[:ss[.uuuuuu]][TZ]
     */
    public $expires = null;

    /**
     * @var array $props
     */
    public $props = [
        'code', 'description', 'amount', 'discount_type', 'expires'
    ];

    /**
     * @var array $enum_fields
     */
    public $enum_fields = [
        'discount_type' => ['Fixed', 'Percent', 'Shipping']
    ];

    /**
     * @var array $number_fields
     */
    public $number_fields = ['amount'];
}