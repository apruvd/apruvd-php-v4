<?php

namespace Apruvd\V4\Responses;

use Apruvd\V4\Responses\Nested\WebhookMerchant;

/**
 * Class ReadWebhookAPIKeyResponse
 * @package Apruvd\V4\Responses
 */
class ReadWebhookAPIKeyResponse extends APIResponse{

    /**
     * @var string $id
     */
    public $id = null; // string
    /**
     * @var string $api_key_id
     */
    public $api_key_id; // string
    /**
     * @var WebhookMerchant $merchant
     */
    public $merchant = null; // string
    /**
     * @var string $name
     */
    public $name = null; // string

    /**
     * ReadWebhookAPIKeyResponse constructor.
     * @param null|array|object $props
     */
    public function __construct($props = null)
    {
        parent::__construct($props);
        if(!empty($props->merchant)){
            $this->merchant = new WebhookMerchant($props->merchant);
        }
    }

}