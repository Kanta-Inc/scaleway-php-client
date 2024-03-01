# OpenAPI\Client\BootscriptsApi

All URIs are relative to https://api.scaleway.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getBootscript()**](BootscriptsApi.md#getBootscript) | **GET** /instance/v1/zones/{zone}/bootscripts/{bootscript_id} | Get bootscripts |
| [**listBootscripts()**](BootscriptsApi.md#listBootscripts) | **GET** /instance/v1/zones/{zone}/bootscripts | List bootscripts |


## `getBootscript()`

```php
getBootscript($zone, $bootscript_id): \OpenAPI\Client\Model\ScalewayInstanceV1GetBootscriptResponse
```

Get bootscripts

Get details of a bootscript with the specified ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\BootscriptsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$bootscript_id = 'bootscript_id_example'; // string

try {
    $result = $apiInstance->getBootscript($zone, $bootscript_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BootscriptsApi->getBootscript: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **bootscript_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1GetBootscriptResponse**](../Model/ScalewayInstanceV1GetBootscriptResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listBootscripts()`

```php
listBootscripts($zone, $arch, $title, $default, $public, $per_page, $page): \OpenAPI\Client\Model\ScalewayInstanceV1ListBootscriptsResponse
```

List bootscripts

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\BootscriptsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$arch = 'arch_example'; // string
$title = 'title_example'; // string
$default = True; // bool
$public = True; // bool
$per_page = 56; // int
$page = 1; // int | Page number

try {
    $result = $apiInstance->listBootscripts($zone, $arch, $title, $default, $public, $per_page, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BootscriptsApi->listBootscripts: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **arch** | **string**|  | [optional] |
| **title** | **string**|  | [optional] |
| **default** | **bool**|  | [optional] |
| **public** | **bool**|  | [optional] |
| **per_page** | **int**|  | [optional] |
| **page** | **int**| Page number | [optional] [default to 1] |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1ListBootscriptsResponse**](../Model/ScalewayInstanceV1ListBootscriptsResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
