<?php

namespace Apruvd\V4\Responses;

use Apruvd\V4\Responses\Nested\WebhookMerchant;
use Apruvd\V4\Responses\Nested\WebookCredentials;

/**
 * Class ReadWebhookResponse
 * @package Apruvd\V4\Responses
 */
class ReadWebhookResponse extends APIResponse{

    /**
     * @var string $id
     */
    public $id = null;
    /**
     * @var WebookCredentials $credentials
     */
    public $credentials = null;
    /**
     * @var WebhookMerchant $merchant
     */
    public $merchant = null;
    /**
     * @var string $event
     */
    public $event = null;
    public $certificate = null;
    /**
     * @var string $url Fully qualified URL
     */
    public $url = null;

    /**
     * ReadWebhookResponse constructor.
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