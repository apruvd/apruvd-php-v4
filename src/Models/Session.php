<?php

namespace Apruvd\V4\Models;

/**
 * Class Session
 * @package Apruvd\V4\Models
 */
class Session extends APIModel{
    /**
     * @var string $id
     */
    public $id = null;
    /**
     * @var string $merchant
     */
    public $merchant = null;
    /**
     * @var string $cc_name_hash SHA256 hash
     */
    public $cc_name_hash = null;
    /**
     * @var string $checkout_hash SHA256 hash
     */
    public $checkout_hash = null;
    /**
     * @var string $auth_attempts
     */
    public $auth_attempts = null;
    /**
     * @var string $cc_number_hash SHA256 hash
     */
    public $cc_number_hash = null;
    /**
     * @var string $iin
     */
    public $iin = null;
    /**
     * @var \DateTime|string $checkout_completed YYYY-MM-DD HH:MM[:ss[.uuuuuu]][TZ]
     */
    public $checkout_completed = null;

    /**
     * @var array $props
     */
    public $props = [
        'id', 'merchant', 'cc_name_hash', 'checkout_hash', 'auth_attempts', 'cc_number_hash', 'iin', 'checkout_completed'
    ];

    /**
     * @var array $string_fields
     */
    public $string_fields = [
        'id', 'merchant', 'cc_name_hash', 'checkout_hash', 'auth_attempts', 'cc_number_hash', 'iin', 'checkout_completed'
    ];
}