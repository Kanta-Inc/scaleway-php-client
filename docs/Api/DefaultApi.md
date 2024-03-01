# OpenAPI\Client\DefaultApi

All URIs are relative to https://api.scaleway.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**attachServerVolume()**](DefaultApi.md#attachServerVolume) | **POST** /instance/v1/zones/{zone}/servers/{server_id}/attach-volume |  |
| [**detachServerVolume()**](DefaultApi.md#detachServerVolume) | **POST** /instance/v1/zones/{zone}/servers/{server_id}/detach-volume |  |
| [**getDashboard()**](DefaultApi.md#getDashboard) | **GET** /instance/v1/zones/{zone}/dashboard |  |


## `attachServerVolume()`

```php
attachServerVolume($zone, $server_id, $attach_server_volume_request): \OpenAPI\Client\Model\ScalewayInstanceV1AttachServerVolumeResponse
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$server_id = 'server_id_example'; // string
$attach_server_volume_request = new \OpenAPI\Client\Model\AttachServerVolumeRequest(); // \OpenAPI\Client\Model\AttachServerVolumeRequest

try {
    $result = $apiInstance->attachServerVolume($zone, $server_id, $attach_server_volume_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->attachServerVolume: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **server_id** | **string**|  | |
| **attach_server_volume_request** | [**\OpenAPI\Client\Model\AttachServerVolumeRequest**](../Model/AttachServerVolumeRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1AttachServerVolumeResponse**](../Model/ScalewayInstanceV1AttachServerVolumeResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `detachServerVolume()`

```php
detachServerVolume($zone, $server_id, $detach_server_volume_request): \OpenAPI\Client\Model\ScalewayInstanceV1DetachServerVolumeResponse
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$server_id = 'server_id_example'; // string
$detach_server_volume_request = new \OpenAPI\Client\Model\DetachServerVolumeRequest(); // \OpenAPI\Client\Model\DetachServerVolumeRequest

try {
    $result = $apiInstance->detachServerVolume($zone, $server_id, $detach_server_volume_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->detachServerVolume: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **server_id** | **string**|  | |
| **detach_server_volume_request** | [**\OpenAPI\Client\Model\DetachServerVolumeRequest**](../Model/DetachServerVolumeRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1DetachServerVolumeResponse**](../Model/ScalewayInstanceV1DetachServerVolumeResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDashboard()`

```php
getDashboard($zone, $organization, $project): \OpenAPI\Client\Model\ScalewayInstanceV1GetDashboardResponse
```



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$organization = 'organization_example'; // string
$project = 'project_example'; // string

try {
    $result = $apiInstance->getDashboard($zone, $organization, $project);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->getDashboard: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **organization** | **string**|  | [optional] |
| **project** | **string**|  | [optional] |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1GetDashboardResponse**](../Model/ScalewayInstanceV1GetDashboardResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
