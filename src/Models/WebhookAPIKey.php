<?php

namespace Apruvd\V4\Models;

/**
 * Class WebhookAPIKey
 * @package Apruvd\V4\Models
 */
class WebhookAPIKey extends APIModel{
    /**
     * @var string $api_key_id
     */
    public $api_key_id = null; // string
    /**
     * @var string $api_key_secret
     */
    public $api_key_secret = null; // String string
    /**
     * @var string $name
     */
    public $name = null; // string

    /**
     * @var array $props
     */
    public $props = [
        'api_key_id', 'api_key_secret', 'name'
    ];

    /**
     * @var array $string_fields
     */
    public $string_fields = [
        'api_key_id', 'api_key_secret', 'name'
    ];
}