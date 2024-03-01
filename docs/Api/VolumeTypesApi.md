# OpenAPI\Client\VolumeTypesApi

All URIs are relative to https://api.scaleway.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**listVolumesTypes()**](VolumeTypesApi.md#listVolumesTypes) | **GET** /instance/v1/zones/{zone}/products/volumes | List volume types |


## `listVolumesTypes()`

```php
listVolumesTypes($zone, $per_page, $page): \OpenAPI\Client\Model\ScalewayInstanceV1ListVolumesTypesResponse
```

List volume types

List all volume types and their technical details.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\VolumeTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$per_page = 56; // int
$page = 1; // int | Page number

try {
    $result = $apiInstance->listVolumesTypes($zone, $per_page, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolumeTypesApi->listVolumesTypes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **per_page** | **int**|  | [optional] |
| **page** | **int**| Page number | [optional] [default to 1] |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1ListVolumesTypesResponse**](../Model/ScalewayInstanceV1ListVolumesTypesResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
