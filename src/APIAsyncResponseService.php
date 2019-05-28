<?php

namespace Apruvd\V4;

use Apruvd\V4\Responses\MerchantWebhookCallback;
use Apruvd\V4\Responses\TransactionWebhookCallback;
use Closure;

/**
 * Class APIAsyncResponseService
 * @package Apruvd\V4
 */
class APIAsyncResponseService{

    /**
     * @param Closure|null $callback
     * @return mixed
     */
    public static function handle(Closure $callback = null){
        $data = json_decode(file_get_contents('php://input'));

        if(!empty($data) && !empty($data->event)){
            $data = new TransactionWebhookCallback($data);
        }
        elseif(!empty($data) && !empty($data->service_plan)){
            $data = new MerchantWebhookCallback($data);
        }

        if($callback !== null){
            return $callback($data);
        }
        else{
            return $data;
        }
    }

    public static function transactionResponse($props = []){
        return new TransactionWebhookCallback($props);
    }

    public static function merchantResponse($props = []){
        return new MerchantWebhookCallback($props);
    }


}