<?php

namespace Apruvd\V4\Responses;

/**
 * Class ReadMerchantsResponse
 * @package Apruvd\V4\Responses
 */
class ReadMerchantsResponse extends APIResponse{

    /**
     * @var boolean $training_data
     */
    public $training_data = null;
    /**
     * @var string $postal_code
     */
    public $postal_code = null;
    /**
     * @var string $enforce_unique_order_id
     */
    public $enforce_unique_order_id = null;
    /**
     * @var string $logo
     */
    public $logo = null;
    /**
     * @var integer $expected_daily_volume
     */
    public $expected_daily_volume = null;
    /**
     * @var boolean $require_notes_on_approves
     */
    public $require_notes_on_approves = null;
    /**
     * @var array $real_time_api_calls
     */
    public $real_time_api_calls = null;
    /**
     * @var string $shop_url
     */
    public $shop_url = null;
    /**
     * @var string $address_line_1
     */
    public $address_line_1 = null;
    /**
     * @var string $city
     */
    public $city = null;
    /**
     * @var string $clear_by
     */
    public $clear_by = null;
    /**
     * @var string|float|double|integer $fee_per_approve
     */
    public $fee_per_approve = null;
    /**
     * @var string $volusion_pw
     */
    public $volusion_pw = null;
    /**
     * @var boolean $require_notes_on_declines
     */
    public $require_notes_on_declines = null;
    /**
     * @var string $max_auto_approve
     */
    public $max_auto_approve = null;
    /**
     * @var string $phone
     */
    public $phone = null;
    /**
     * @var string $service_plan
     */
    public $service_plan = null;
    /**
     * @var string|object $organization
     */
    public $organization = null;
    /**
     * @var boolean $strictly_protect_pii
     */
    public $strictly_protect_pii = null;
    /**
     * @var string|float|double|integer $chargeback_fee
     */
    public $chargeback_fee = null;
    /**
     * @var string|float|double|integer $commission
     */
    public $commission = null;
    /**
     * @var string $integration_version
     */
    public $integration_version = null;
    /**
     * @var string $country
     */
    public $country = null;
    /**
     * @var string|float|double|integer $fee_per_decline
     */
    public $fee_per_decline = null;
    /**
     * @var \DateTime|string $added YYYY-MM-DD HH:MM[:ss[.uuuuuu]][TZ]
     */
    public $added = null;
    /**
     * @var string  $chargeback_communication_time Time 00:00:00
     */
    public $chargeback_communication_time = null;
    /**
     * @var string $volusion_url
     */
    public $volusion_url = null;
    /**
     * @var boolean $auto_review
     */
    public $auto_review = null;
    /**
     * @var string $name
     */
    public $name = null;
    /**
     * @var string $id
     */
    public $id = null;
    /**
     * @var string $price_change_communication_time Time 00:00:00
     */
    public $price_change_communication_time = null;
    /**
     * @var string $volusion_email
     */
    public $volusion_email = null;
    /**
     * @var string $address_line_2
     */
    public $address_line_2 = null;
    /**
     * @var array $basic_rules
     */
    public $basic_rules = null;
    /**
     * @var string $turnaround_time Time 00:00:00
     */
    public $turnaround_time = null;
    /**
     * @var boolean $data_connection
     */
    public $data_connection = null;
    /**
     * @var string $time_zone Ex: US/Central
     */
    public $time_zone = null;
    /**
     * @var string $platform
     */
    public $platform = null;
    /**
     * @var string $state_or_province
     */
    public $state_or_province = null;

}