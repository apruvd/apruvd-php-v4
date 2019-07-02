<?php

namespace Apruvd\V4;

use Apruvd\V4\Models\Session;
use Apruvd\V4\Models\Transaction;
use Apruvd\V4\Models\Webhook;
use Apruvd\V4\Models\WebhookAPIKey;
use Apruvd\V4\Responses\APIResponse;
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
use Closure;
use Httpful\Mime;
use Httpful\Request;

/**
 * Class APIService
 * @package Apruvd\V4
 */
class APIService{

    /**
     * @var string $host
     */
    private $host = 'https://api.apruvd.com/';
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
     * @var Closure $token_update_callback
     */
    private $token_update_callback = null;

    private $token_retry_attempted = false;

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
     * @return string
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
     * @return string
     */
    public function getRefreshToken(){
        return $this->refresh_token;
    }

    /**
     * Read single Merchant by ID.
     * @param string $id
     * @return ReadMerchantsResponse;
     */
    public function readMerchants($id){
        $uri = "accounts/merchants/{$id}/";
        $response = \Httpful\Request::get($this->host.$uri);
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new ReadMerchantsResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->readMerchants($id);
        }
        return $apiResponse;
    }

    /**
     * Create access token from refresh token.
     * @return CreateMerchantAccessTokenResponse
     */
    public function createMerchantAccessToken(){
        $uri = "accounts/merchants/access_tokens/";
        $response = \Httpful\Request::post($this->host.$uri, '')
            ->addHeader('Authorization', 'Bearer '.$this->refresh_token)
            ->sends(Mime::JSON)->send();
        $token = new CreateMerchantAccessTokenResponse($response);
        if($token->success){
            $this->token = $token->token;
            if(is_object($this->token_update_callback) && ($this->token_update_callback instanceof Closure)){
                call_user_func_array($this->token_update_callback, [$token]);
            }
        }
        return $token;
    }

    /**
     * Create access token from refresh token.
     * @param Closure $callback
     */
    public function onAccessTokenUpdate(Closure $callback){
        $this->token_update_callback = $callback;
    }

    /**
     * Create refresh token from auth credentials.
     * @return CreateMerchantRefeshTokenResponse
     */
    public function createMerchantRefreshToken(){
        $uri = "accounts/merchants/refresh_tokens/";
        $response = \Httpful\Request::post($this->host.$uri, '')
            ->addHeader('Authorization', 'Basic '.base64_encode($this->key_id.':'.$this->key_secret))
            ->sends(Mime::JSON)->send();
        $token = new CreateMerchantRefeshTokenResponse($response);
        if($token->success){
            $this->refresh_token = $token->token;
        }
        return $token;
    }

    /**
     * List Webhook API Keys.
     * @param int $page
     * @param int $page_size
     * @return ListWebhookAPIKeysResponse
     */
    public function listWebhookAPIKeys($page, $page_size){
        $uri = "accounts/webhooks/api_keys/?page={$page}&page_size={$page_size}";
        $response = \Httpful\Request::get($this->host.$uri);
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new ListWebhookAPIKeysResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->listWebhookAPIKeys($page, $page_size);
        }
        return $apiResponse;
    }

    /**
     * Create Webhook API Key.
     * @param WebhookAPIKey $webhook_api_key
     * @return UpsertWebhookAPIKeyResponse
     */
    public function createWebhookAPIKey(WebhookAPIKey $webhook_api_key){
        $uri = "accounts/webhooks/api_keys/";
        $response = \Httpful\Request::post($this->host.$uri, json_encode($webhook_api_key));
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new UpsertWebhookAPIKeyResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->createWebhookAPIKey($webhook_api_key);
        }
        return $apiResponse;
    }

    /**
     * Read single Webhook API Key by ID.
     * @param string $id
     * @return ReadWebhookAPIKeyResponse
     */
    public function readWebhookAPIKey($id){
        $uri = "accounts/webhooks/api_keys/{$id}/";
        $response = \Httpful\Request::get($this->host.$uri);
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new ReadWebhookAPIKeyResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->readWebhookAPIKey($id);
        }
        return $apiResponse;
    }

    /**
     * Overwrite single Webhook API Key by ID.
     * @param string $id
     * @param WebhookAPIKey $webhook_api_key
     * @return UpsertWebhookAPIKeyResponse
     */
    public function updateWebhookAPIKey($id, WebhookAPIKey $webhook_api_key){
        $uri = "accounts/webhooks/api_keys/{$id}/";
        $response = \Httpful\Request::put($this->host.$uri, json_encode($webhook_api_key));
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new UpsertWebhookAPIKeyResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->updateWebhookAPIKey($id, $webhook_api_key);
        }
        return $apiResponse;
    }

    /**
     * Update partial single Webhook API Key by ID.
     * @param string $id
     * @param WebhookAPIKey $webhook_api_key
     * @return UpsertWebhookAPIKeyResponse
     */
    public function partialUpdateWebhookAPIKey($id, WebhookAPIKey $webhook_api_key){
        $uri = "accounts/webhooks/api_keys/{$id}/";
        $response = \Httpful\Request::patch($this->host.$uri, json_encode($webhook_api_key));
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new UpsertWebhookAPIKeyResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->partialUpdateWebhookAPIKey($id, $webhook_api_key);
        }
        return $apiResponse;
    }

    /**
     * Delete single Webhook API Key by ID.
     * @return APIResponse
     */
    public function deleteWebhookAPIKey($id){
        $uri = "accounts/webhooks/api_keys/{$id}/";
        $response = \Httpful\Request::delete($this->host.$uri);
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new APIResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->deleteWebhookAPIKey($id);
        }
        return $apiResponse;
    }

    /**
     * List Webhooks.
     * @param int $page
     * @param int $page_size
     * @return ListWebhooksResponse
     */
    public function listWebhooks($page, $page_size){
        $uri = "accounts/webhooks/?page={$page}&page_size={$page_size}";
        $response = \Httpful\Request::get($this->host.$uri);
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new ListWebhooksResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->listWebhooks($page, $page_size);
        }
        return $apiResponse;
    }

    /**
     * Create Webhook.
     * @param Webhook $webhook
     * @return UpsertWebhookResponse
     */
    public function createWebhook(Webhook $webhook){
        $uri = "accounts/webhooks/";
        $response = \Httpful\Request::post($this->host.$uri, json_encode($webhook));
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new UpsertWebhookResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->createWebhook($webhook);
        }
        return $apiResponse;
    }

    /**
     * Read single Webhook by ID.
     * @param string $id
     * @return ReadWebhookResponse
     */
    public function readWebhook($id){
        $uri = "accounts/webhooks/{$id}/";
        $response = \Httpful\Request::get($this->host.$uri);
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new ReadWebhookResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->readWebhook($id);
        }
        return $apiResponse;
    }

    /**
     * Overwrite single Webhook by ID.
     * @param string $id
     * @param Webhook $webhook
     * @return UpsertWebhookResponse
     */
    public function updateWebhook($id, Webhook $webhook){
        $uri = "accounts/webhooks/{$id}/";
        $response = \Httpful\Request::put($this->host.$uri, json_encode($webhook));
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new UpsertWebhookResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->updateWebhook($id, $webhook);
        }
        return $apiResponse;
    }

    /**
     * Update partial single Webhook by ID.
     * @param string $id
     * @param Webhook $webhook
     * @return UpsertWebhookResponse
     */
    public function partialUpdateWebhook($id, Webhook $webhook){
        $uri = "accounts/webhooks/{$id}/";
        $response = \Httpful\Request::patch($this->host.$uri, json_encode($webhook));
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new UpsertWebhookResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->partialUpdateWebhook($id, $webhook);
        }
        return $apiResponse;
    }

    /**
     * Delete single Webhook API Key by ID.
     * @return APIResponse
     */
    public function deleteWebhook($id){
        $uri = "accounts/webhooks/{$id}/";
        $response = \Httpful\Request::delete($this->host.$uri);
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new APIResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->deleteWebhook($id);
        }
        return $apiResponse;
    }

    /**
     * Create Transaction.
     * @param Transaction $transaction
     * @return UpsertTransactionResponse
     */
    public function createTransaction(Transaction $transaction){
        $uri = "transactions/";
        $response = \Httpful\Request::post($this->host.$uri, json_encode($transaction));
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new UpsertTransactionResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->createTransaction($transaction);
        }
        return $apiResponse;
    }

    /**
     * Read single Transaction (Order) by Order ID.
     * @param string $id
     * @return ReadTransactionResponse
     */
    public function readOrderByID($id){
        $uri = "transactions/by_order_id/{$id}/";
        $response = \Httpful\Request::get($this->host.$uri);
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new ReadTransactionResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->readOrderByID($id);
        }
        return $apiResponse;
    }

    /**
     * Read single Transaction (Order) by Transaction ID.
     * @param string $id
     * @return ReadTransactionResponse
     */
    public function readOrderByTransactionID($id){
        $uri = "transactions/{$id}/";
        $response = \Httpful\Request::get($this->host.$uri);
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new ReadTransactionResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->readOrderByTransactionID($id);
        }
        return $apiResponse;
    }

    /**
     * Overwrite single Transaction (Order) by ID.
     * @param string $id
     * @param Transaction $transaction
     * @return UpsertTransactionResponse
     */
    public function updateOrderByID($id, Transaction $transaction){
        $uri = "transactions/by_order_id/{$id}/";
        $response = \Httpful\Request::put($this->host.$uri, json_encode($transaction));
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new UpsertTransactionResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->updateOrderByID($id, $transaction);
        }
        return $apiResponse;
    }

    /**
     * Overwrite single Transaction (Order) by Transaction ID.
     * @param Transaction $transaction
     * @return UpsertTransactionResponse
     */
    public function updateOrderByTransactionID(Transaction $transaction){
        $uri = "transactions/{$transaction->id}/";
        $response = \Httpful\Request::put($this->host.$uri, json_encode($transaction));
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new UpsertTransactionResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->updateOrderByTransactionID($transaction);
        }
        return $apiResponse;
    }

    /**
     * Update partial single Transaction (Order) by ID.
     * @param string $id
     * @param Transaction $transaction
     * @return UpsertTransactionResponse
     */
    public function partialUpdateOrderByID($id, Transaction $transaction){
        $uri = "transactions/by_order_id/{$id}/";
        $response = \Httpful\Request::patch($this->host.$uri, json_encode($transaction));
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new UpsertTransactionResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->partialUpdateOrderByID($id, $transaction);
        }
        return $apiResponse;
    }

    /**
     * Update partial single Transaction (Order) by Transaction ID.
     * @param Transaction $transaction
     * @return UpsertTransactionResponse
     */
    public function partialUpdateOrderByTransactionID(Transaction $transaction){
        $uri = "transactions/{$transaction->id}/";
        $response = \Httpful\Request::patch($this->host.$uri, json_encode($transaction));
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new UpsertTransactionResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->partialUpdateOrderByTransactionID($transaction);
        }
        return $apiResponse;
    }

    /**
     * Create Session.
     * @param Session $session
     * @return CreateSessionResponse
     */
    public function createSession(Session $session){
        $uri = "transactions/sessions/";
        $response = \Httpful\Request::post($this->host.$uri, json_encode($session));
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new CreateSessionResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->createSession($session);
        }
        return $apiResponse;
    }

    /**
     * Overwrite single Session by ID.
     * @param string $id
     * @param Session $session
     * @return UpsertSessionResponse
     */
    public function updateSession($id, Session $session){
        $uri = "transactions/sessions/{$id}/";
        $response = \Httpful\Request::put($this->host.$uri, json_encode($session));
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new UpsertSessionResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->updateSession($id, $session);
        }
        return $apiResponse;
    }

    /**
     * Update partial single Session by ID.
     * @param string $id
     * @param Session $session
     * @return UpsertSessionResponse
     */
    public function partialUpdateSession($id, Session $session){
        $uri = "transactions/sessions/{$id}/";
        $response = \Httpful\Request::patch($this->host.$uri, json_encode($session));
        $response = $this->bindAuthorization($response);
        $response = $response->sends(Mime::JSON)->send();
        $apiResponse = new UpsertSessionResponse($response);
        if($this->retryNewToken($apiResponse)){
            $apiResponse = $this->partialUpdateSession($id, $session);
        }
        return $apiResponse;
    }

    /**
     * Add Auth headers to Httpful request.
     * @param Request $request
     * @return Request
     */
    protected function bindAuthorization(Request $request){
        if(!empty($this->token)){
            $request->addHeader('Authorization', 'Bearer '.$this->token);
        }
        elseif(!empty($this->refresh_token)){
            $token = $this->createMerchantAccessToken();
            if($token){
                $this->token = $token->token;
                $request->addHeader('Authorization', 'Bearer '.$this->token);
            }
            else{
                $request->addHeader('Authorization', 'Basic '.base64_encode($this->key_id.':'.$this->key_secret));
            }
        }
        else{
            $request->addHeader('Authorization', 'Basic '.base64_encode($this->key_id.':'.$this->key_secret));
        }
        return $request;
    }

    /**
     * Sniff response for missing/expired Access Token when Refresh Token is known.
     * @param APIResponse $response
     * @return boolean
     */
    protected function retryNewToken(APIResponse $response){
        if($response->code == 403 && $response->detail === 'Invalid or expired access token' && !empty($this->refresh_token) && !$this->token_retry_attempted ){
            // Will trigger onAccessTokenUpdate() callback on success
            $this->token_retry_attempted = true;
            $token = $this->createMerchantAccessToken();
            if($token->success){
                return true;
            }
        }
        return false;
    }

}
