<?php

namespace Apruvd\V4\Responses;

/**
 * Class CreateMerchantRefeshTokenResponse
 * @package Apruvd\V4\Responses
 */
class CreateMerchantRefeshTokenResponse extends APIResponse{

    /**
     * @var string $id
     */
    public $id = null;
    /**
     * @var string $token
     */
    public $token = null;
    /**
     * @var string $merchant
     */
    public $merchant = null;
    /**
     * @var string $api_key
     */
    public $api_key = null;
    /**
     * @var \DateTime|string $expires
     */
    public $expires = null;

}