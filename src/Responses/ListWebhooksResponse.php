<?php

namespace Apruvd\V4\Responses;

use Apruvd\V4\Responses\Nested\ListWebhooksResult;

/**
 * Class ListWebhooksResponse
 * @package Apruvd\V4\Responses
 */
class ListWebhooksResponse extends APIResponse{

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
     * @var array $results ListWebhookResult[]
     */
    public $results = null;

    /**
     * ListWebhooksResponse constructor.
     * @param null|array|object $props
     */
    public function __construct($props = null)
    {
        parent::__construct($props);
        if(!empty($props->results) && is_array($props->results)){
            $results = [];
            foreach($props->results as $result){
                $results[] = new ListWebhooksResult($result);
            }
            $this->results = $results;
        }
    }
}