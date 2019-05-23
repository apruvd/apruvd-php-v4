<?php

namespace Apruvd\V4\Responses\Nested;

use Apruvd\V4\Responses\APIResponse;

/**
 * Class ListWebhooksResult
 * @package Apruvd\V4\Responses\Nested
 */
class ListWebhooksResult extends APIResponse {
    /**
     * @var string $id
     */
    public $id = null; // string
    /**
     * @var WebookCredentials $credentials
     */
    public $credentials = null; // WebookCredentials;
    /**
     * @var WebhookMerchant $merchant
     */
    public $merchant = null; // WebhookMerchant;
    /**
     * @var string $event
     */
    public $event = null; // string
    /**
     * @var null|object|string $certificate
     */
    public $certificate = null; // ?null

    /**
     * ListWebhooksResult constructor.
     * @param null|array|object $props
     */
    public function __construct($props = null)
    {
        parent::__construct($props);

        if(!empty($props->merchant)){
            $this->merchant = new WebhookMerchant($props->merchant);
        }
        if(!empty($props->credentials)){
            $this->credentials = new WebookCredentials($props->credentials);
        }
    }
}