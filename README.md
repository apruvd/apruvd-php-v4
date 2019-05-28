# apruvd_v4_php

Lightweight PHP SDK for integrating with the Apruvd API V4 (soon to be released).

API documentation found here.
https://v4-dev.apruvd.com/docs/

## Services
### APIService
The main primary service containing 1:1 method mapping on available API endpoints.
```
$service = new APIService('$merchant_id', 'secret_id', 'secret_key', 'optional_refresh_token', 'optional_access_token');
$service->{endpoint_method}();
```

### APIAsyncResponseService
The optional service to grab/transform $_POST JSON data into the appropriate response model. The ```$s```
```
$callback = function($post_response){ ... };
\Apruvd\V4\APIAsyncResponseService::handle($callback);
// or if you don't require a callback function, you can get the response directly in your route/controller
$response = \Apruvd\V4\APIAsyncResponseService::handle();
// or if your framework supports JSON request parsing, you can create a response model from that object/array.
$response = \Apruvd\V4\APIAsyncResponseService::transactionResponse($json_object)
```

## Authentication
There are 2 viable authentication patterns for the v3 API. secret id/key and refresh/access tokens.
#### Secret ID/Key
This key pair is generated in the application settings page and is used as a basic authentication scheme. All calls can be made using this key key set. The refresh/access token authentication method is completely optional
#### Refresh/Access Tokens
Using your secret id/key you can request a refresh token using the following method:
```
$token = $service->createMerchantRefreshToken();
```
A token set will be returned and automatically binded to the service class. When new tokens are generated an optional anonymous callback function can be passed to the API service as an event handler.
```
$service->onAccessTokenUpdate(function($token){ ... });
```
If a refresh token has been binded via service constructor, subsequent API calls will automatically request a new access token on missing or failed attempts. This process can additionally be handled via direct call.
```
$token = $service->createMerchantAccessToken();
```
It's recommended that the onAccessTokenUpdate method be used with your prefered storage routine and that the refresh and access tokens can be recalled and passed via service constructor.

## Models
#### Transaction and Cart Contents
For model details please refer to the codebase and the API docs. All model types can take object/array property sets for constructor hydration.
```
$transaction = new Transaction([
    "order_id" => "Trans".time(),
    "discount_codes" => [
        new DiscountCode([
            'description' => 'description'
        ]);
    ],
    "cart_contents" => [
        new CartContent([
            'product' => new Product([
               'unique_id' => 'Product'.time(),
               'product_type' => 'Physical',
               'category' => 'Foo',
            ]),
            'quantity' => 10,
            'unit_price' => 5.21,
            'is_gift' => false,
            'gift_message' => 'gift '.time()
        ])
    ]
]);
$response = $service->createTransaction($transaction);
```

## Responses
All responses are well formed and documented. The following properties of the APIModel class are available to all responses, with each response binding it's own additional properties.
* ```$response->code``` - integer | HTTP Response Code
* ```$response->detail``` - string | Possible 400/500 error response message
* ```$response->success``` - boolean | Was HTTP within 200 range
* ```$response->validation_errors``` - object | Possible 400 validation error response messages. Nested Object.
* ```$response->response``` - Httpful\Response | Fully formed response from Httpful service. Useful for debugging.


## API Methods and Endpoints
##### readMerchants(String $id) : ReadMerchantsResponse
Submits to ```accounts/merchants/{$id}/``` as GET
##### createMerchantAccessToken() : CreateMerchantAccessTokenResponse
Submits to ```accounts/merchants/access_tokens/``` as POST
##### createMerchantRefreshToken() : CreateMerchantRefeshTokenResponse
Submits to ```accounts/merchants/refresh_tokens/``` as POST
##### listWebhookAPIKeys(int $page, int $page_size) : ListWebhookAPIKeysResponse
Submits to ```accounts/webhooks/api_keys/?page={$page}&page_size={$page_size}``` as GET
##### createWebhookAPIKey(WebhookAPIKey $webhook_api_key) : UpsertWebhookAPIKeyResponse
Submits to ```accounts/webhooks/api_keys/``` as POST
##### readWebhookAPIKey(String $id) : ReadWebhookAPIKeyResponse
Submits to ```accounts/webhooks/api_keys/{$id}/``` as GET
##### updateWebhookAPIKey(String $id, WebhookAPIKey $webhook_api_key) : UpsertWebhookAPIKeyResponse
Submits to ```accounts/webhooks/api_keys/{$id}/``` as PUT
##### partialUpdateWebhookAPIKey(String $id, WebhookAPIKey $webhook_api_key) : UpsertWebhookAPIKeyResponse
Submits to ```accounts/webhooks/api_keys/{$id}/``` as PATCH
##### deleteWebhookAPIKey(String $id) : APIResponse
Submits to ```accounts/webhooks/api_keys/{$id}/``` as DELETE
##### listWebhooks(int $page, int $page_size) : ListWebhooksResponse
Submits to ```accounts/webhooks/?page={$page}&page_size={$page_size}``` as GET
##### createWebhook(Webhook $webhook) : UpsertWebhookResponse
Submits to ```accounts/webhooks/``` as POST
##### readWebhook(String $id) : ReadWebhookResponse
Submits to ```accounts/webhooks/{$id}/``` as GET
##### updateWebhook(String $id, Webhook $webhook) : UpsertWebhookResponse
Submits to ```accounts/webhooks/{$id}/``` as PUT
##### partialUpdateWebhook(String $id, Webhook $webhook) : UpsertWebhookResponse
Submits to ```accounts/webhooks/{$id}/``` as PATCH
##### deleteWebhook(String $id) : APIResponse
Submits to ```accounts/webhooks/{$id}/``` as DELETE
##### createTransaction(Transaction $transaction) : UpsertTransactionResponse
Submits to ```transactions/``` as POST
##### readOrderByID(String $id) : ReadTransactionResponse
Submits to ```transactions/by_order_id/{$id}/``` as GET
##### updateOrderByID(String $id, Transaction $transaction) : UpsertTransactionResponse
Submits to ```transactions/by_order_id/{$id}/``` as PUT
##### partialUpdateOrderByID(String $id, Transaction $transaction) : UpsertTransactionResponse
Submits to ```transactions/by_order_id/{$id}/``` as PATCH
##### createSession(Session $session) : CreateSessionResponse
Submits to ```transactions/sessions/``` as POST
##### updateSession(String $id, Session $session) : UpsertSessionResponse
Submits to ```transactions/sessions/``` as PUT
##### partialUpdateSession(String $id, Session $session) : UpsertSessionResponse
Submits to ```transactions/sessions/``` as PATCH

## Helper Methods
##### onAccessTokenUpdate(Closure $callback)
Registers the single event handler for Token Update events. This maps to a single property, only one callback per event cycle.
##### setToken(String $token)
##### getToken() : String
##### setRefreshToken(String $token)
##### getRefreshToken() : String
