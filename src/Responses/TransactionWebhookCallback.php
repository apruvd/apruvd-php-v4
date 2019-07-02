<?php

namespace Apruvd\V4\Responses;

use Apruvd\V4\Responses\Nested\CallbackNote;

/**
 * Class TransactionWebhookCallback
 * @package Apruvd\V4\Responses
 */
class TransactionWebhookCallback extends APICallback{

    /**
     * @var string $transaction_id
     */
    public $transaction_id = null;

    /**
     * @var string $merchant
     */
    public $merchant = null;

    /**
     * @var string $status
     */
    public $status = null;

    /**
     * @var string $order_num
     */
    public $order_num = null;

    /**
     * @var string $corrected_email
     */
    public $corrected_email = null;

    /**
     * @var object $changelog Object{'DateTime':{'property_name':{'to':'','from':''}}}
     */
    public $changelog = null;

    /**
     * @var array $notes CallbackNote[]
     */
    public $notes = null;

    /**
     * TransactionWebhookCallback constructor.
     * @param null|array|object $props
     */
    public function __construct($props = null)
    {
        parent::__construct($props);

        if(!empty($props->notes) && is_array($props->notes)){
            $notes = [];
            foreach($props->notes as $note){
                $notes[] = new CallbackNote($note);
            }
            $this->notes = $notes;
        }
    }

}
