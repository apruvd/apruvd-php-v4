<?php

namespace Apruvd\V4\Responses\Nested;

/**
 * Class History
 * @package Apruvd\V4\Responses\Nested
 */
class History extends NestedHydrator {

    /**
     * @var boolean $has_cb
     */
    public $has_cb = null; // boolean
    /**
     * @var int $level_1_linked_approves
     */
    public $level_1_linked_approves = null; // int
    /**
     * @var int $level_1_linked_declines
     */
    public $level_1_linked_declines = null; // int
    /**
     * @var int $level_2_linked_approves
     */
    public $level_2_linked_approves = null; // int
    /**
     * @var int $level_2_linked_declines
     */
    public $level_2_linked_declines = null; // int
    public $max_card_approve = null; // ? null
    public $max_confident_approve = null; // ? null
    /**
     * @var boolean $email_cc_approved_30_days
     */
    public $email_cc_approved_30_days = null; // boolean
    /**
     * @var boolean $email_approved_60_days
     */
    public $email_approved_60_days = null; // boolean
    /**
     * @var integer $level_1_linkages
     */
    public $level_1_linkages = null; // int
    /**
     * @var integer $level_2_linkages
     */
    public $level_2_linkages = null; // int
    /**
     * @var integer $level_1_chargebacks
     */
    public $level_1_chargebacks = null; // int
    /**
     * @var integer $level_2_chargebacks
     */
    public $level_2_chargebacks = null; // int
    public $email = null; // ? PropertyHistory?
    public $egc_recipient = null; // ? PropertyHistory?
    public $billing_phone = null; // ? PropertyHistory?
    public $shipping_phone = null; // ? PropertyHistory?
    public $called_from = null; // ? PropertyHistory?
    public $billing_address_id = null; // ? null
    public $shipping_address_id = null; // ? null
    public $threatmetrix_proxy_ip = null; // ? null
    public $threatmetrix_true_ip = null; // ? null
    public $cc_number_hash = null; // ? PropertyHistory?
    public $payment_token = null; // ? PropertyHistory?
    public $ach_account_hash = null; // ? PropertyHistory?
    public $customer_id = null; // ? PropertyHistory?
    public $session_alt = null; // ? null
    public $session_id = null; // ? null
    public $threatmetrix_exact_id = null; // ? null
    public $threatmetrix_smart_id = null; // ? null
    public $threatmetrix_online_id = null; // ? null
    public $threatmetrix_device_fp = null; // ? null
    public $threatmetrix_ach_id = null; // ? null
    public $threatmetrix_agent_device_id = null; // ? null
    public $threatmetrix_digital_id = null; // ? null
    public $maxmind_device_id = null; // ? null
    public $email_username = null; // ? PropertyHistory?
    public $egc_recipient_username = null; // ? PropertyHistory?
    public $billing_persona_slug = null; // ? PropertyHistory?
    public $shipping_persona_slug = null; // ? PropertyHistory?
    public $billing_address_slug = null; // ? PropertyHistory?
    public $shipping_address_slug = null; // ? PropertyHistory?
}