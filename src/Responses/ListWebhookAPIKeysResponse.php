<?php

namespace Apruvd\V4\Responses;

use Apruvd\V4\Responses\Nested\ListWebhooksAPIKeyResult;

/**
 * Class ListWebhookAPIKeysResponse
 * @package Apruvd\V4\Responses
 */
class ListWebhookAPIKeysResponse extends APIResponse{

    /**
     * @var integer $count
     */
    public $count = null;
    /**
     * @var string $next API URL
     */
    public $next = null;
    /**
     * @var string $previous API URL
     */
    public $previous = null;
    /**
     * @var array $results ListWebhooksAPIKeyResult[]
     */
    public $results = null;

    /**
     * ListWebhookAPIKeysResponse constructor.
     * @param null|array|object $props
     */
    public function __construct($props = null)
    {
        parent::__construct($props);
        if(!empty($props->results) && is_array($props->results)){
            $results = [];
            foreach($props->results as $result){
                $results[] = new ListWebhooksAPIKeyResult($result);
            }
            $this->results = $results;
        }
    }
}