<?php

namespace Apruvd\V4\Responses;

/**
 * Class UpsertWebhookAPIKeyResponse
 * @package Apruvd\V4\Responses
 */
class UpsertWebhookAPIKeyResponse extends APIResponse{

    /**
     * @var string $id
     */
    public $id = null;
    /**
     * @var string $api_key_secret
     */
    public $api_key_secret = null;
    /**
     * @var string $api_key_id
     */
    public $api_key_id;
    /**
     * @var string $merchant
     */
    public $merchant = null;
    /**
     * @var string $name
     */
    public $name = null;

}