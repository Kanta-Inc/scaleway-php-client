# OpenAPI\Client\InstanceTypesApi

All URIs are relative to https://api.scaleway.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getServerTypesAvailability()**](InstanceTypesApi.md#getServerTypesAvailability) | **GET** /instance/v1/zones/{zone}/products/servers/availability | Get availability |
| [**listServersTypes()**](InstanceTypesApi.md#listServersTypes) | **GET** /instance/v1/zones/{zone}/products/servers | List Instance types |


## `getServerTypesAvailability()`

```php
getServerTypesAvailability($zone, $per_page, $page): \OpenAPI\Client\Model\ScalewayInstanceV1GetServerTypesAvailabilityResponse
```

Get availability

Get availability for all Instance types.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\InstanceTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$per_page = 56; // int | A positive integer lower or equal to 100 to select the number of items to return.
$page = 1; // int | A positive integer to choose the page to return.

try {
    $result = $apiInstance->getServerTypesAvailability($zone, $per_page, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstanceTypesApi->getServerTypesAvailability: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **per_page** | **int**| A positive integer lower or equal to 100 to select the number of items to return. | [optional] |
| **page** | **int**| A positive integer to choose the page to return. | [optional] [default to 1] |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1GetServerTypesAvailabilityResponse**](../Model/ScalewayInstanceV1GetServerTypesAvailabilityResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listServersTypes()`

```php
listServersTypes($zone, $per_page, $page): \OpenAPI\Client\Model\ScalewayInstanceV1ListServersTypesResponse
```

List Instance types

List available Instance types and their technical details.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\InstanceTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$per_page = 56; // int
$page = 1; // int | Page number

try {
    $result = $apiInstance->listServersTypes($zone, $per_page, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstanceTypesApi->listServersTypes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **per_page** | **int**|  | [optional] |
| **page** | **int**| Page number | [optional] [default to 1] |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1ListServersTypesResponse**](../Model/ScalewayInstanceV1ListServersTypesResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
