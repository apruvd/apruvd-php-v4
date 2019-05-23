<?php

namespace Apruvd\V4\Responses;

/**
 * Class CreateMerchantAccessTokenResponse
 * @package Apruvd\V4\Responses
 */
class CreateMerchantAccessTokenResponse extends APIResponse{

    /**
     * @var string $id
     */
    public $id = null;
    /**
     * @var string $token
     */
    public $token = null;
    /**
     * @var string $refresh_token
     */
    public $refresh_token;
    /**
     * @var \DateTime|string $expires
     */
    public $expires = null;
    /**
     * @var string $merchant
     */
    public $merchant = null;

}