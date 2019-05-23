<?php

namespace Apruvd\V4\Responses;

/**
 * Class UpsertSessionResponse
 * @package Apruvd\V4\Responses
 */
class UpsertSessionResponse extends APIResponse{

    /**
     * @var string $cc_name_hash
     */
    public $cc_name_hash = null;
    /**
     * @var string $checkout_hash
     */
    public $checkout_hash = null;
    /**
     * @var integer $auth_attempts
     */
    public $auth_attempts = null;
    /**
     * @var string $cc_number_hash
     */
    public $cc_number_hash = null;
    /**
     * @var string $iin
     */
    public $iin = null;
    /**
     * @var string $id
     */
    public $id = null;
    /**
     * @var \DateTime|string $checkout_completed YYYY-MM-DD HH:MM[:ss[.uuuuuu]][TZ]
     */
    public $checkout_completed = null;

}