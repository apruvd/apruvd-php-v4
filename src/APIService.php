<?php

namespace Apruvd\V4;

use Apruvd\V4\Models\Session;
use Apruvd\V4\Models\Transaction;
use Apruvd\V4\Models\Webhook;
use Apruvd\V4\Models\WebhookAPIKey;
use Apruvd\V4\Responses\CreateMerchantAccessTokenResponse;
use Apruvd\V4\Responses\CreateMerchantRefeshTokenResponse;
use Apruvd\V4\Responses\CreateSessionResponse;
use Apruvd\V4\Responses\ListWebhookAPIKeysResponse;
use Apruvd\V4\Responses\ReadTransactionResponse;
use Apruvd\V4\Responses\ReadWebhookResponse;
use Apruvd\V4\Responses\UpsertSessionResponse;
use Apruvd\V4\Responses\UpsertTransactionResponse;
use Apruvd\V4\Responses\UpsertWebhookResponse;
use Apruvd\V4\Responses\ListWebhooksResponse;
use Apruvd\V4\Responses\ReadMerchantsResponse;
use Apruvd\V4\Responses\ReadWebhookAPIKeyResponse;
use Apruvd\V4\Responses\UpsertWebhookAPIKeyResponse;
use Httpful\Mime;

/**
 * Class APIService
 * @package Apruvd\V4
 */
class APIService{

    /**
     * @var string $host
     */
    private $host = 'https://v4-dev.apruvd.com/';
    /**
     * @var string $merchant_id
     */
    private $merchant_id = '';
    /**
     * @var string $key_id
     */
    private $key_id = '';
    /**
     * @var string $key_secret
     */
    private $key_secret = '';
    /**
     * @var string $refresh_token
     */
    private $refresh_token = '';
    /**
     * @var string $token
     */
    private $token = '';

    /**
     * @var $last_response
     */
    private $last_response = null;

    /**
     * APIService constructor.
     * @param string $merchant_id
     * @param string $key_id
     * @param string $key_secret
     * @param string|null $refresh_token
     * @param string|null $token
     */
    public function __construct($merchant_id, $key_id, $key_secret, $refresh_token = null, $token = null)
    {
        $this->merchant_id = $merchant_id;
        $this->key_id = $key_id;
        $this->key_secret = $key_secret;
        $this->refresh_token = $refresh_token;
        $this->token = $token;

        if(!empty($this->token)){
            // try preflight request?
            // Yeah, do the self merchant detail

            // check for 403 code
            // {"detail":"Invalid or expired access token"}

            if(!empty($this->refresh_token)){

            }
        }
        elseif(!empty($this->refresh_token)){

        }
        else{
            // Authenticate
        }
    }

    /**
     * Token setter.
     * @param string $token
     */
    public function setToken($token){
        if(is_string($token) && !empty($token)){
            $this->token = $token;
        }
    }
    /**
     * Token getter.
     */
    public function getToken(){
        return $this->token;
    }
    /**
     * Refresh Token setter.
     * @param string $token
     */
    public function setRefreshToken($token){
        if(is_string($token) && !empty($token)){
            $this->refresh_token = $token;
        }
    }
    /**
     * Refresh Token getter.
     */
    public function getRefreshToken(){
        return $this->refresh_token;
    }

    /**
     * API failure response getter.
     */
    public function lastResponse(){
        return $this->last_response;
    }

    /**
     * Read single Merchant by ID.
     * @param string $id
     */
    public function readMerchants($id){
        $uri = "accounts/merchants/{$id}/";
        $response = \Httpful\Request::get($this->host.$uri)
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new ReadMerchantsResponse($response->body);
        }
        return null;
    }

    /**
     * Create access token from refresh token.
     */
    public function createMerchantAccessToken(){
        $uri = "accounts/merchants/access_tokens/";
        $response = \Httpful\Request::post($this->host.$uri, '')
            ->addHeader('Authorization', 'Bearer '.$this->refresh_token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new CreateMerchantAccessTokenResponse($response->body);
        }
        return null;
    }

    /**
     * Create refresh token from auth credentials.
     */
    public function createMerchantRefreshToken(){
        $uri = "accounts/merchants/refresh_tokens/";
        $response = \Httpful\Request::post($this->host.$uri, '')
            ->addHeader('Authorization', 'Basic '.base64_encode($this->key_id.':'.$this->key_secret))
            ->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new CreateMerchantRefeshTokenResponse($response->body);
        }
        return null;
    }

    /**
     * List Webhook API Keys.
     * @param int $page
     * @param int $page_size
     */
    public function listWebhookAPIKeys($page, $page_size){
        $uri = "accounts/webhooks/api_keys/?page={$page}&page_size={$page_size}";
        $response = \Httpful\Request::get($this->host.$uri)
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new ListWebhookAPIKeysResponse($response->body);
        }
        return null;
    }

    /**
     * Create Webhook API Key.
     * @param WebhookAPIKey $webhook_api_key
     */
    public function createWebhookAPIKey(WebhookAPIKey $webhook_api_key){
        $uri = "accounts/webhooks/api_keys/";
        $response = \Httpful\Request::post($this->host.$uri, json_encode($webhook_api_key))
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new UpsertWebhookAPIKeyResponse($response->body);
        }
        return null;
    }

    /**
     * Read single Webhook API Key by ID.
     * @param string $id
     */
    public function readWebhookAPIKey($id){
        $uri = "accounts/webhooks/api_keys/{$id}/";
        $response = \Httpful\Request::get($this->host.$uri)
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new ReadWebhookAPIKeyResponse($response->body);
        }
        return null;
    }

    /**
     * Overwrite single Webhook API Key by ID.
     * @param string $id
     * @param WebhookAPIKey $webhook_api_key
     */
    public function updateWebhookAPIKey($id, WebhookAPIKey $webhook_api_key){
        $uri = "accounts/webhooks/api_keys/{$id}/";
        $response = \Httpful\Request::put($this->host.$uri, json_encode($webhook_api_key))
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new UpsertWebhookAPIKeyResponse($response->body);
        }
        return null;
    }

    /**
     * Update partial single Webhook API Key by ID.
     * @param string $id
     * @param WebhookAPIKey $webhook_api_key
     */
    public function partialUpdateWebhookAPIKey($id, WebhookAPIKey $webhook_api_key){
        $uri = "accounts/webhooks/api_keys/{$id}/";
        $response = \Httpful\Request::patch($this->host.$uri, json_encode($webhook_api_key))
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new UpsertWebhookAPIKeyResponse($response->body);
        }
        return null;
    }

    /**
     * Delete single Webhook API Key by ID.
     */
    public function deleteWebhookAPIKey($id){
        $uri = "accounts/webhooks/api_keys/{$id}/";
        $response = \Httpful\Request::delete($this->host.$uri)
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            // returns null anyway
            return true;
        }
        return null;
    }

    /**
     * List Webhooks.
     * @param int $page
     * @param int $page_size
     */
    public function listWebhooks($page, $page_size){
        $uri = "accounts/webhooks/?page={$page}&page_size={$page_size}";
        $response = \Httpful\Request::get($this->host.$uri)
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new ListWebhooksResponse($response->body);
        }
        return null;
    }

    /**
     * Create Webhook.
     * @param Webhook $webhook
     */
    public function createWebhook(Webhook $webhook){
        $uri = "accounts/webhooks/";
        $response = \Httpful\Request::post($this->host.$uri, json_encode($webhook))
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new UpsertWebhookResponse($response->body);
        }
        return null;
    }

    /**
     * Read single Webhook by ID.
     * @param string $id
     */
    public function readWebhook($id){
        $uri = "accounts/webhooks/{$id}/";
        $response = \Httpful\Request::get($this->host.$uri)
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new ReadWebhookResponse($response->body);
        }
        return null;
    }

    /**
     * Overwrite single Webhook by ID.
     * @param string $id
     * @param Webhook $webhook
     */
    public function updateWebhook($id, Webhook $webhook){
        $uri = "accounts/webhooks/{$id}/";
        $response = \Httpful\Request::put($this->host.$uri, json_encode($webhook))
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new UpsertWebhookResponse($response->body);
        }
        return null;
    }

    /**
     * Update partial single Webhook by ID.
     * @param string $id
     * @param Webhook $webhook
     */
    public function partialUpdateWebhook($id, Webhook $webhook){
        $uri = "accounts/webhooks/{$id}/";
        $response = \Httpful\Request::patch($this->host.$uri, json_encode($webhook))
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new UpsertWebhookResponse($response->body);
        }
        return null;
    }

    /**
     * Delete single Webhook API Key by ID.
     */
    public function deleteWebhook($id){
        $uri = "accounts/webhooks/{$id}/";
        $response = \Httpful\Request::delete($this->host.$uri)
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return true;
        }
        return null;
    }

    /**
     * Create Transaction.
     * @param Transaction $transaction
     */
    public function createTransaction(Transaction $transaction){
        $uri = "transactions/";
        $response = \Httpful\Request::post($this->host.$uri, json_encode($transaction))
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new UpsertTransactionResponse($response->body);
        }
        return null;
    }

    /**
     * Read single Transaction (Order) by ID.
     * @param string $id
     */
    public function readOrderByID($id){
        $uri = "transactions/by_order_id/{$id}/";
        $response = \Httpful\Request::get($this->host.$uri)
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new ReadTransactionResponse($response->body);
        }
        return null;
    }

    /**
     * Overwrite single Transaction (Order) by ID.
     * @param string $id
     * @param Transaction $transaction
     */
    public function updateOrderByID($id, Transaction $transaction){
        $uri = "transactions/by_order_id/{$id}/";
        $response = \Httpful\Request::put($this->host.$uri, json_encode($transaction))
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new UpsertTransactionResponse($response->body);
        }
        return null;
    }

    /**
     * Update partial single Transaction (Order) by ID.
     * @param string $id
     * @param Transaction $transaction
     */
    public function partialUpdateOrderByID($id, Transaction $transaction){
        $uri = "transactions/by_order_id/{$id}/";
        $response = \Httpful\Request::patch($this->host.$uri, json_encode($transaction))
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new UpsertTransactionResponse($response->body);
        }
        return null;
    }

    /**
     * Create Session.
     * @param Session $session
     */
    public function createSession(Session $session){
        $uri = "transactions/sessions/";
        $response = \Httpful\Request::post($this->host.$uri, json_encode($session))
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new CreateSessionResponse($response->body);
        }
        return null;
    }

    /**
     * Overwrite single Session by ID.
     * @param string $id
     * @param Session $session
     */
    public function updateSession($id, Session $session){
        $uri = "transactions/sessions/{$id}/";
        $response = \Httpful\Request::put($this->host.$uri, json_encode($session))
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new UpsertSessionResponse($response->body);
        }
        return null;
    }

    /**
     * Update partial single Session by ID.
     * @param string $id
     * @param Session $session
     */
    public function partialUpdateSession($id, Session $session){
        $uri = "transactions/sessions/{$id}/";
        $response = \Httpful\Request::patch($this->host.$uri, json_encode($session))
            ->addHeader('Authorization', 'Bearer '.$this->token)->sendsAndExpects(Mime::JSON)->send();

        $this->last_response = $response;
        if($response->code >=200 && $response->code < 300){
            return new UpsertSessionResponse($response->body);
        }
        return null;
    }

}