<?php

namespace Apruvd\V4\Responses;

/**
 * Class CreateSessionResponse
 * @package Apruvd\V4\Responses
 */
class CreateSessionResponse extends APIResponse{

    /**
     * @var string $id
     */
    public $id = null; // string UUID
    /**
     * @var string $merchant
     */
    public $merchant = null; // string UUID

}