# OpenAPI\Client\PrivateNICsApi

All URIs are relative to https://api.scaleway.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createPrivateNIC()**](PrivateNICsApi.md#createPrivateNIC) | **POST** /instance/v1/zones/{zone}/servers/{server_id}/private_nics | Create a private NIC connecting an Instance to a Private Network |
| [**deletePrivateNIC()**](PrivateNICsApi.md#deletePrivateNIC) | **DELETE** /instance/v1/zones/{zone}/servers/{server_id}/private_nics/{private_nic_id} | Delete a private NIC |
| [**getPrivateNIC()**](PrivateNICsApi.md#getPrivateNIC) | **GET** /instance/v1/zones/{zone}/servers/{server_id}/private_nics/{private_nic_id} | Get a private NIC |
| [**listPrivateNICs()**](PrivateNICsApi.md#listPrivateNICs) | **GET** /instance/v1/zones/{zone}/servers/{server_id}/private_nics | List all private NICs |
| [**updatePrivateNIC()**](PrivateNICsApi.md#updatePrivateNIC) | **PATCH** /instance/v1/zones/{zone}/servers/{server_id}/private_nics/{private_nic_id} | Update a private NIC |


## `createPrivateNIC()`

```php
createPrivateNIC($zone, $server_id, $create_private_nic_request): \OpenAPI\Client\Model\ScalewayInstanceV1CreatePrivateNICResponse
```

Create a private NIC connecting an Instance to a Private Network

Create a private NIC connecting an Instance to a Private Network.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PrivateNICsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$server_id = 'server_id_example'; // string | UUID of the Instance the private NIC will be attached to.
$create_private_nic_request = new \OpenAPI\Client\Model\CreatePrivateNICRequest(); // \OpenAPI\Client\Model\CreatePrivateNICRequest

try {
    $result = $apiInstance->createPrivateNIC($zone, $server_id, $create_private_nic_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNICsApi->createPrivateNIC: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **server_id** | **string**| UUID of the Instance the private NIC will be attached to. | |
| **create_private_nic_request** | [**\OpenAPI\Client\Model\CreatePrivateNICRequest**](../Model/CreatePrivateNICRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1CreatePrivateNICResponse**](../Model/ScalewayInstanceV1CreatePrivateNICResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deletePrivateNIC()`

```php
deletePrivateNIC($zone, $server_id, $private_nic_id)
```

Delete a private NIC

Delete a private NIC.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PrivateNICsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$server_id = 'server_id_example'; // string | Instance to which the private NIC is attached.
$private_nic_id = 'private_nic_id_example'; // string | Private NIC unique ID.

try {
    $apiInstance->deletePrivateNIC($zone, $server_id, $private_nic_id);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNICsApi->deletePrivateNIC: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **server_id** | **string**| Instance to which the private NIC is attached. | |
| **private_nic_id** | **string**| Private NIC unique ID. | |

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

## `getPrivateNIC()`

```php
getPrivateNIC($zone, $server_id, $private_nic_id): \OpenAPI\Client\Model\ScalewayInstanceV1GetPrivateNICResponse
```

Get a private NIC

Get private NIC properties.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PrivateNICsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$server_id = 'server_id_example'; // string | Instance to which the private NIC is attached.
$private_nic_id = 'private_nic_id_example'; // string | Private NIC unique ID.

try {
    $result = $apiInstance->getPrivateNIC($zone, $server_id, $private_nic_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNICsApi->getPrivateNIC: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **server_id** | **string**| Instance to which the private NIC is attached. | |
| **private_nic_id** | **string**| Private NIC unique ID. | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1GetPrivateNICResponse**](../Model/ScalewayInstanceV1GetPrivateNICResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listPrivateNICs()`

```php
listPrivateNICs($zone, $server_id, $tags, $per_page, $page): \OpenAPI\Client\Model\ScalewayInstanceV1ListPrivateNICsResponse
```

List all private NICs

List all private NICs of a specified Instance.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PrivateNICsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$server_id = 'server_id_example'; // string | Instance to which the private NIC is attached.
$tags = 'tags_example'; // string | Private NIC tags.
$per_page = 56; // int | A positive integer lower or equal to 100 to select the number of items to return.
$page = 1; // int | A positive integer to choose the page to return.

try {
    $result = $apiInstance->listPrivateNICs($zone, $server_id, $tags, $per_page, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNICsApi->listPrivateNICs: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **server_id** | **string**| Instance to which the private NIC is attached. | |
| **tags** | **string**| Private NIC tags. | [optional] |
| **per_page** | **int**| A positive integer lower or equal to 100 to select the number of items to return. | [optional] |
| **page** | **int**| A positive integer to choose the page to return. | [optional] [default to 1] |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1ListPrivateNICsResponse**](../Model/ScalewayInstanceV1ListPrivateNICsResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updatePrivateNIC()`

```php
updatePrivateNIC($zone, $server_id, $private_nic_id, $update_private_nic_request): \OpenAPI\Client\Model\ScalewayInstanceV1PrivateNIC
```

Update a private NIC

Update one or more parameter(s) of a specified private NIC.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PrivateNICsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$server_id = 'server_id_example'; // string | UUID of the Instance the private NIC will be attached to.
$private_nic_id = 'private_nic_id_example'; // string | Private NIC unique ID.
$update_private_nic_request = new \OpenAPI\Client\Model\UpdatePrivateNICRequest(); // \OpenAPI\Client\Model\UpdatePrivateNICRequest

try {
    $result = $apiInstance->updatePrivateNIC($zone, $server_id, $private_nic_id, $update_private_nic_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PrivateNICsApi->updatePrivateNIC: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **server_id** | **string**| UUID of the Instance the private NIC will be attached to. | |
| **private_nic_id** | **string**| Private NIC unique ID. | |
| **update_private_nic_request** | [**\OpenAPI\Client\Model\UpdatePrivateNICRequest**](../Model/UpdatePrivateNICRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1PrivateNIC**](../Model/ScalewayInstanceV1PrivateNIC.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
