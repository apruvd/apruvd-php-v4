<?php

namespace Apruvd\V4\Models;

/**
 * Class Transaction
 * @package Apruvd\V4\Models
 */
class Transaction extends APIModel{
    // Settings
    /**
     * @var string $order_id
     */
    public $order_id = null;
    /**
     * @var \DateTime|string $merchant_timestamp YYYY-MM-DD HH:MM[:ss[.uuuuuu]][TZ]
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
     * @var array $tags String[] array
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
     * @var string $ip_address IPv4|IPv6 Format
     */
    public $ip_address = null;
    /**
     * @var string $referer_uri Fully qualified URL
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
     * @var float|double|integer $total
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
     * @var string $cc_number_hash SHA256 hash of full card number (Private Salt)
     */
    public $cc_number_hash = null;
    /**
     * @var string $avs_response Unenforced ENUM outlined in enum_fields property comments
     */
    public $avs_response = null;
    /**
     * @var string $cvv_response Unenforced ENUM outlined in enum_fields property comments
     */
    public $cvv_response = null;
    /**
     * @var integer|string $auth_attempts
     */
    public $auth_attempts = null;
    /**
     * @var string $shipping_speed ENUM outlined in enum_fields property
     */
    public $shipping_speed = null;
    /**
     * @var float|double|integer $shipping_cost
     */
    public $shipping_cost = null;
    /**
     * @var string $shipping_cost_currency ENUM outlined in enum_fields property
     */
    public $shipping_cost_currency = null;
    /**
     * @var string $ach_routing_number
     */
    public $ach_routing_number = null;
    /**
     * @var string $ach_account_hash SHA256 hash of full card number (Private Salt)
     */
    public $ach_account_hash = null;
    /**
     * @var string $payment_token Credit card payment token. Must not be a Primary Account Number (PAN) or simple transformation of PAN
     */
    public $payment_token = null;

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
     * @var array $discount_codes DiscountCode[] array
     */
    public $discount_codes = null;
    /**
     * @var array $cart_contents CartContent[] array
     */
    public $cart_contents = null;

    /**
     * @var array $props
     */
    protected $props = [
        'order_id','merchant_timestamp','mode','status','contact_email','contact_phone','tags',
        'customer_id','email','called_from','billing_phone','shipping_phone','egc_recipient','ip_address','referer_uri',
        'affiliate_id','subaffiliate_id','accept_language','user_agent','browser_width','browser_height','total',
        'total_currency','payment_type','iin','last_four','cardholder_name','cc_number_hash','avs_response','cvv_response',
        'auth_attempts','shipping_speed','shipping_cost','shipping_cost_currency','ach_routing_number','ach_account_hash',
        'payment_token','billing_name','billing_address_1','billing_address_2','billing_company','billing_city',
        'billing_postal_code','billing_state_or_province','billing_country','shipping_name','shipping_address_1',
        'shipping_address_2','shipping_company','shipping_city','shipping_postal_code','shipping_state_or_province',
        'shipping_country','discount_codes','cart_contents'];

    /**
     * @var array $enum_fields
     */
    protected $enum_fields = [
        'mode' => ['Live', 'Trial', 'Test'],
        'status' => ['Submitted', 'Historical', ' Training, Data'],
        'total_currency' => ['USD', 'CAD', 'GBP', 'EUR', 'AUD'],
        'shipping_speed' => [
            'Standard','Expedited','Third Day','Second Day','Next Day','Same Day','International',
            'International Expedited','Express Saturday'
        ],
        'shipping_cost_currency' => ['USD', 'CAD', 'GBP', 'EUR', 'AUD'],
        'payment_type' => ['Credit', 'ACH', 'Installments', 'Wallet', 'Other'],

        // These Enums are optional
        /*'avs' => [
            'X','Y','A','W','Z','N','U','R','E','S','D','M','B','P','C','I','G','I1','I2','I3','I4','I5','I6','I7','I8',
            'IG','IU','ID','IE','IS','IA','IB','IC','IP','N1','N2','A1','A3','A4','A7','B3','B4','B7','B8','V',''
        ],
        'cvv' => ['M','N','P','S','U']*/
    ];

    /**
     * @var array $integer_fields
     */
    protected $integer_fields = ['browser_width','browser_height','auth_attempts', 'ach_routing_number'];

    /**
     * @var array $number_fields
     */
    protected $number_fields = ['total'];

    /**
     * @var array $required_fields
     */
    protected $required_fields = ['order_id', 'total'];

    /**
     * @var array $string_fields
     */
    protected $string_fields = [
        'order_id','merchant_timestamp','contact_email','contact_phone','customer_id','email','called_from',
        'billing_phone','shipping_phone','egc_recipient','ip_address','referer_uri',
        'affiliate_id','subaffiliate_id','accept_language','user_agent','browser_width','iin', 'last_four',
        'cardholder_name','cc_number_hash','avs_response','cvv_response',
        'shipping_speed','shipping_cost','shipping_cost_currency','ach_routing_number','ach_account_hash',
        'payment_token','billing_name','billing_address_1','billing_address_2','billing_company','billing_city',
        'billing_postal_code','billing_state_or_province','billing_country','shipping_name','shipping_address_1',
        'shipping_address_2','shipping_company','shipping_city','shipping_postal_code','shipping_state_or_province',
        'shipping_country','discount_codes','cart_contents'
    ];
}