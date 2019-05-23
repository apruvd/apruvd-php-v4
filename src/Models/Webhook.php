<?php

namespace Apruvd\V4\Models;

/**
 * Class Webhook
 * @package Apruvd\V4\Models
 */
class Webhook extends APIModel{
    /**
     * @var string $event ENUM outlined in enum_fields property
     */
    public $event = null; // ENUM
    /**
     * @var string $credentials
     */
    public $credentials = null; // String auth
    /**
     * @var string $url Fully qualified URL
     */
    public $url = null; // string URL

    /**
     * @var array $props
     */
    public $props = [
        'event', 'credentials', 'url'
    ];

    /**
     * @var array $string_fields
     */
    public $string_fields = [
        'credentials', 'url'
    ];

    /**
     * @var array $enum_fields
     */
    public $enum_fields = [
        'event' => ['Review Complete', 'Chargeback Update', 'Data Correction', 'Fraud Alert', 'Merchant Settings Update']
    ];
}