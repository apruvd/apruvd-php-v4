<?php

namespace Apruvd\V4\Responses;
use Httpful\Response;

/**
 * Class APIResponse Base class for API response hydration
 * @package Apruvd\V4\Responses
 */
class APIResponse{

    /**
     * @var Response $response;
     */
    public $response = null;

    /**
     * @var int $code;
     */
    public $code = null;

    /**
     * @var string $detail;
     */
    public $detail = null;

    /**
     * @var boolean $success;
     */
    public $success = false;

    /**
     * @var mixed $validation_errors;
     */
    public $validation_errors = null;


    /**
     * APIResponse constructor.
     * @param Response|Object $response
     */
    public function __construct(Response $response = null)
    {
        $this->response = $response;
        $this->code = $response->code;
        if($this->code >= 200 && $this->code < 300){
            $this->success = true;
            if(!empty($response->body) && (is_array($response->body) || is_object($response->body))){
                foreach($response->body as $prop => $value){
                    $this->{$prop} = $value;
                }
            }
        }
        elseif($this->code == 400){
            // 400 returns itemized validation sets.
            if(!empty($response->body) && (is_array($response->body) || is_object($response->body))){
                $this->validation_errors = $response->body;
            }
        }
        else{
            if(!empty($response->body) && (is_array($response->body) || is_object($response->body))){
                foreach($response->body as $prop => $value){
                    $this->{$prop} = $value;
                }
            }
        }
    }
}