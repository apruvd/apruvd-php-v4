<?php

namespace Apruvd\V4\Responses\Nested;

/**
 * Class PropertyHistory
 * @package Apruvd\V4\Responses\Nested
 */
class PropertyHistory extends NestedHydrator {

    public $disposition = null; // ? null
    /**
     * @var array $related_ids
     */
    public $related_ids = null;
    /**
     * @var integer $times_seen
     */
    public $times_seen = null;
    /**
     * @var integer $num_approves
     */
    public $num_approves = null;
    /**
     * @var integer $num_declines
     */
    public $num_declines = null;
    /**
     * @var integer $max_total_approved
     */
    public $max_total_approved = null;
    public $most_recent_decision = null; // ? null
    /**
     * @var array $chargeback_ids
     */
    public $chargeback_ids = null;

}