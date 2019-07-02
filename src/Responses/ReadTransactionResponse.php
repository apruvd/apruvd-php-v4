<?php

namespace Apruvd\V4\Responses;

use Apruvd\V4\Models\DiscountCode;
use Apruvd\V4\Responses\Nested\WebhookMerchant;

/**
 * Class ReadTransactionResponse
 * @package Apruvd\V4\Responses
 */
class ReadTransactionResponse extends APIResponse{

    // Settings
    /**
     * @var string $order_id
     */
    public $order_id = null;
    /**
     * @var string $merchant_timestamp DateTime YYYY-MM-DD HH:MM[:ss[.uuuuuu]][TZ]
     */
    public $merchant_timestamp = null;
    /**
     * @var string $mode ENUM outlined in enum_fields property
     */
    public $mode = null;
    /**
     * @var string $status ENUM outlined in enum_fields property
     */
    public $status = null;
    /**
     * @var string $contact_email Valid Email
     */
    public $contact_email = null;
    /**
     * @var string $contact_phone
     */
    public $contact_phone = null;
    /**
     * @var array $tags String[]
     */
    public $tags = null;

    // Customer
    /**
     * @var string $customer_id
     */
    public $customer_id = null;
    /**
     * @var string $email Valid Email
     */
    public $email = null;
    /**
     * @var string $called_from
     */
    public $called_from = null;
    /**
     * @var string $billing_phone
     */
    public $billing_phone = null;
    /**
     * @var string $shipping_phone
     */
    public $shipping_phone = null;
    /**
     * @var string $egc_recipient Valid Email
     */
    public $egc_recipient = null;

    // Web Details
    /**
     * @var string $ip_address IPv4|IPv6
     */
    public $ip_address = null;
    /**
     * @var string $referer_uri URL
     */
    public $referer_uri = null;
    /**
     * @var string $affiliate_id
     */
    public $affiliate_id = null;
    /**
     * @var string $subaffiliate_id
     */
    public $subaffiliate_id = null;
    /**
     * @var string $accept_language HTTP "Accept-Language" header
     */
    public $accept_language = null;
    /**
     * @var string $user_agent HTTP "User-Agent" header
     */
    public $user_agent = null;
    /**
     * @var integer $browser_width
     */
    public $browser_width = null;
    /**
     * @var integer $browser_height
     */
    public $browser_height = null;

    // Payment
    /**
     * @var string|float|double|integer $total
     */
    public $total = null;
    /**
     * @var string $total_currency ENUM outlined in enum_fields property
     */
    public $total_currency = null;
    /**
     * @var string $payment_type ENUM outlined in enum_fields property
     */
    public $payment_type = null;
    /**
     * @var string $iin CC first 6 digits
     */
    public $iin = null;
    /**
     * @var string $last_four CC last 4 digits
     */
    public $last_four = null;
    /**
     * @var string $cardholder_name
     */
    public $cardholder_name = null;
    /**
     * @var string $avs_response Unenforced ENUM outlined in enum_fields property
     */
    public $avs_response = null;
    /**
     * @var string $cvv_response Unenforced ENUM outlined in enum_fields property
     */
    public $cvv_response = null;
    /**
     * @var string
     */
    public $auth_attempts = null;
    /**
     * @var string $shipping_speed ENUM outlined in enum_fields property
     */
    public $shipping_speed = null;
    /**
     * @var string|float|double|integer
     */
    public $shipping_cost = null;
    /**
     * @var string $shipping_cost_currency ENUM outlined in enum_fields property
     */
    public $shipping_cost_currency = null;

    // Billing
    /**
     * @var string $billing_name
     */
    public $billing_name = null;
    /**
     * @var string $billing_address_1
     */
    public $billing_address_1 = null;
    /**
     * @var string $billing_address_2
     */
    public $billing_address_2 = null;
    /**
     * @var string $billing_company
     */
    public $billing_company = null;
    /**
     * @var string $billing_city
     */
    public $billing_city = null;
    /**
     * @var string $billing_postal_code
     */
    public $billing_postal_code = null;
    /**
     * @var string $billing_state_or_province
     */
    public $billing_state_or_province = null;
    /**
     * @var string $billing_country ISO 3166-1 alpha-2 country code
     */
    public $billing_country = null;

    // Shipping
    /**
     * @var string $shipping_name
     */
    public $shipping_name = null;
    /**
     * @var string $shipping_address_1
     */
    public $shipping_address_1 = null;
    /**
     * @var string $shipping_address_2
     */
    public $shipping_address_2 = null;
    /**
     * @var string $shipping_company
     */
    public $shipping_company = null;
    /**
     * @var string $shipping_city
     */
    public $shipping_city = null;
    /**
     * @var string $shipping_postal_code
     */
    public $shipping_postal_code = null;
    /**
     * @var string $shipping_state_or_province
     */
    public $shipping_state_or_province = null;
    /**
     * @var string $shipping_country ISO 3166-1 alpha-2 country code
     */
    public $shipping_country = null;

    // Related items
    /**
     * @var array $discount_codes DiscountCode[]
     */
    public $discount_codes = null;
    /**
     * @var array $cart_contents CartContent[]
     */
    public $cart_contents = null;

    public $session = null;
    /**
     * @var string $id
     */
    public $id = null;
    public $submitted_by = null;
    /**
     * @var string $timestamp  DateTime ATOM
     */
    public $timestamp = null;
    /**
     * @var string $session_alt
     */
    public $session_alt = null;


    /**
     * @var string|float|double|integer $charge
     */
    public $charge = null;
    public $billing_lat = null;
    public $billing_long = null;
    /**
     * @var string|float|double|integer $commission
     */
    public $commission = null;
    /**
     * @var string|float|double|integer $usd_conversion_rate
     */
    public $usd_conversion_rate = null;
    public $shipping_lat = null;
    public $shipping_long = null;
    /**
     * @var string $charge_currency
     */
    public $charge_currency = null;
    public $information_request = null;
    public $chargeback = null;
    /**
     * @var WebhookMerchant $merchant
     */
    public $merchant = null;
    /**
     * @var string|float|double|integer $usd_charge
     */
    public $usd_charge = null;
    public $invoice = null;
    public $batch = null;
    /**
     * @var array $basic_rules_tripped
     */
    public $basic_rules_tripped = null;


    /**
     * ReadTransactionResponse constructor.
     * @param null|array|object $props
     */
    public function __construct($props = null)
    {
        parent::__construct($props);

        if(!empty($props->discount_codes) && is_array($props->discount_codes)){
            $codes = [];
            foreach($props->discount_codes as $code){
                $codes[] = new DiscountCode($code);
            }
            $this->discount_codes = $codes;
        }
        if(!empty($props->cart_contents)){
            $contents = [];
            foreach($props->cart_contents as $content){
                $contents[] = new DiscountCode($content);
            }
            $this->cart_contents = $contents;
        }
        if(!empty($props->merchant)){
            $this->merchant = new WebhookMerchant($props->merchant);
        }
    }
}
