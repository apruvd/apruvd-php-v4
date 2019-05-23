<?php

namespace Apruvd\V4\Responses\Nested;

use Apruvd\V4\Responses\APIResponse;

/**
 * Class ListWebhooksAPIKeyResult
 * @package Apruvd\V4\Responses\Nested
 */
class ListWebhooksAPIKeyResult extends APIResponse {
    /**
     * @var string $id
     */
    public $id = null; // string
    /**
     * @var WebhookMerchant $merchant
     */
    public $merchant = null; // WebhookMerchant;
    /**
     * @var string $name
     */
    public $name = null; // string
    /**
     * @var string $api_key_id
     */
    public $api_key_id = null; // string

    /**
     * ListWebhooksAPIKeyResult constructor.
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