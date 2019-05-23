<?php

namespace Apruvd\V4\Responses;

/**
 * Class UpsertWebhookResponse
 * @package Apruvd\V4\Responses
 */
class UpsertWebhookResponse extends APIResponse{

    /**
     * @var string $id
     */
    public $id = null;
    /**
     * @var string $credentials
     */
    public $credentials = null;
    /**
     * @var string $merchant
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

}