# OpenAPI\Client\UserDataApi

All URIs are relative to https://api.scaleway.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**deleteServerUserData()**](UserDataApi.md#deleteServerUserData) | **DELETE** /instance/v1/zones/{zone}/servers/{server_id}/user_data/{key} | Delete user data |
| [**getServerUserData()**](UserDataApi.md#getServerUserData) | **GET** /instance/v1/zones/{zone}/servers/{server_id}/user_data/{key} | Get user data |
| [**listServerUserData()**](UserDataApi.md#listServerUserData) | **GET** /instance/v1/zones/{zone}/servers/{server_id}/user_data | List user data |
| [**setServerUserData()**](UserDataApi.md#setServerUserData) | **PATCH** /instance/v1/zones/{zone}/servers/{server_id}/user_data/{key} | Add/set user data |


## `deleteServerUserData()`

```php
deleteServerUserData($zone, $server_id, $key)
```

Delete user data

Delete the specified key from an Instance's user data.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\UserDataApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$server_id = 'server_id_example'; // string | UUID of the Instance.
$key = 'key_example'; // string | Key of the user data to delete.

try {
    $apiInstance->deleteServerUserData($zone, $server_id, $key);
} catch (Exception $e) {
    echo 'Exception when calling UserDataApi->deleteServerUserData: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **server_id** | **string**| UUID of the Instance. | |
| **key** | **string**| Key of the user data to delete. | |

### Return type

void (empty response body)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getServerUserData()`

```php
getServerUserData($zone, $server_id, $key): \OpenAPI\Client\Model\ScalewayStdFile
```

Get user data

Get the content of a user data with the specified key on an Instance.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\UserDataApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$server_id = 'server_id_example'; // string | UUID of the Instance.
$key = 'key_example'; // string | Key of the user data to get.

try {
    $result = $apiInstance->getServerUserData($zone, $server_id, $key);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserDataApi->getServerUserData: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **server_id** | **string**| UUID of the Instance. | |
| **key** | **string**| Key of the user data to get. | |

### Return type

[**\OpenAPI\Client\Model\ScalewayStdFile**](../Model/ScalewayStdFile.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listServerUserData()`

```php
listServerUserData($zone, $server_id): \OpenAPI\Client\Model\ScalewayInstanceV1ListServerUserDataResponse
```

List user data

List all user data keys registered on a specified Instance.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\UserDataApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$server_id = 'server_id_example'; // string | UUID of the Instance.

try {
    $result = $apiInstance->listServerUserData($zone, $server_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserDataApi->listServerUserData: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **server_id** | **string**| UUID of the Instance. | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1ListServerUserDataResponse**](../Model/ScalewayInstanceV1ListServerUserDataResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setServerUserData()`

```php
setServerUserData($zone, $server_id, $key, $body)
```

Add/set user data

Add or update a user data with the specified key on an Instance.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\UserDataApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$server_id = 'server_id_example'; // string | UUID of the Instance.
$key = 'key_example'; // string | Key of the user data to set.
$body = "/path/to/file.txt"; // \SplFileObject

try {
    $apiInstance->setServerUserData($zone, $server_id, $key, $body);
} catch (Exception $e) {
    echo 'Exception when calling UserDataApi->setServerUserData: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **server_id** | **string**| UUID of the Instance. | |
| **key** | **string**| Key of the user data to set. | |
| **body** | **\SplFileObject****\SplFileObject**|  | |

### Return type

void (empty response body)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
