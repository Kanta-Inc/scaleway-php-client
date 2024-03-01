# OpenAPI\Client\IPsApi

All URIs are relative to https://api.scaleway.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createIp()**](IPsApi.md#createIp) | **POST** /instance/v1/zones/{zone}/ips | Reserve a flexible IP |
| [**deleteIp()**](IPsApi.md#deleteIp) | **DELETE** /instance/v1/zones/{zone}/ips/{ip} | Delete a flexible IP |
| [**getIp()**](IPsApi.md#getIp) | **GET** /instance/v1/zones/{zone}/ips/{ip} | Get a flexible IP |
| [**listIps()**](IPsApi.md#listIps) | **GET** /instance/v1/zones/{zone}/ips | List all flexible IPs |
| [**updateIp()**](IPsApi.md#updateIp) | **PATCH** /instance/v1/zones/{zone}/ips/{ip} | Update a flexible IP |


## `createIp()`

```php
createIp($zone, $create_ip_request): \OpenAPI\Client\Model\ScalewayInstanceV1CreateIpResponse
```

Reserve a flexible IP

Reserve a flexible IP and attach it to the specified Instance.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\IPsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$create_ip_request = new \OpenAPI\Client\Model\CreateIpRequest(); // \OpenAPI\Client\Model\CreateIpRequest

try {
    $result = $apiInstance->createIp($zone, $create_ip_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling IPsApi->createIp: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **create_ip_request** | [**\OpenAPI\Client\Model\CreateIpRequest**](../Model/CreateIpRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1CreateIpResponse**](../Model/ScalewayInstanceV1CreateIpResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteIp()`

```php
deleteIp($zone, $ip)
```

Delete a flexible IP

Delete the IP with the specified ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\IPsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$ip = 'ip_example'; // string | ID or address of the IP to delete.

try {
    $apiInstance->deleteIp($zone, $ip);
} catch (Exception $e) {
    echo 'Exception when calling IPsApi->deleteIp: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **ip** | **string**| ID or address of the IP to delete. | |

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

## `getIp()`

```php
getIp($zone, $ip): \OpenAPI\Client\Model\ScalewayInstanceV1GetIpResponse
```

Get a flexible IP

Get details of an IP with the specified ID or address.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\IPsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$ip = 'ip_example'; // string | IP ID or address to get.

try {
    $result = $apiInstance->getIp($zone, $ip);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling IPsApi->getIp: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **ip** | **string**| IP ID or address to get. | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1GetIpResponse**](../Model/ScalewayInstanceV1GetIpResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listIps()`

```php
listIps($zone, $project, $organization, $tags, $name, $per_page, $page, $type): \OpenAPI\Client\Model\ScalewayInstanceV1ListIpsResponse
```

List all flexible IPs

List all flexible IPs in a specified zone.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\IPsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$project = 'project_example'; // string | Project ID in which the IPs are reserved.
$organization = 'organization_example'; // string | Organization ID in which the IPs are reserved.
$tags = 'tags_example'; // string | Filter IPs with these exact tags (to filter with several tags, use commas to separate them).
$name = 'name_example'; // string | Filter on the IP address (Works as a LIKE operation on the IP address).
$per_page = 56; // int | A positive integer lower or equal to 100 to select the number of items to return.
$page = 1; // int | A positive integer to choose the page to return.
$type = 'type_example'; // string | Filter on the IP Mobility IP type (whose value should be either 'nat', 'routed_ipv4' or 'routed_ipv6').

try {
    $result = $apiInstance->listIps($zone, $project, $organization, $tags, $name, $per_page, $page, $type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling IPsApi->listIps: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **project** | **string**| Project ID in which the IPs are reserved. | [optional] |
| **organization** | **string**| Organization ID in which the IPs are reserved. | [optional] |
| **tags** | **string**| Filter IPs with these exact tags (to filter with several tags, use commas to separate them). | [optional] |
| **name** | **string**| Filter on the IP address (Works as a LIKE operation on the IP address). | [optional] |
| **per_page** | **int**| A positive integer lower or equal to 100 to select the number of items to return. | [optional] |
| **page** | **int**| A positive integer to choose the page to return. | [optional] [default to 1] |
| **type** | **string**| Filter on the IP Mobility IP type (whose value should be either &#39;nat&#39;, &#39;routed_ipv4&#39; or &#39;routed_ipv6&#39;). | [optional] |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1ListIpsResponse**](../Model/ScalewayInstanceV1ListIpsResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateIp()`

```php
updateIp($zone, $ip, $update_ip_request): \OpenAPI\Client\Model\ScalewayInstanceV1UpdateIpResponse
```

Update a flexible IP

Update a flexible IP in the specified zone with the specified ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\IPsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$ip = 'ip_example'; // string | IP ID or IP address.
$update_ip_request = new \OpenAPI\Client\Model\UpdateIpRequest(); // \OpenAPI\Client\Model\UpdateIpRequest

try {
    $result = $apiInstance->updateIp($zone, $ip, $update_ip_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling IPsApi->updateIp: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **ip** | **string**| IP ID or IP address. | |
| **update_ip_request** | [**\OpenAPI\Client\Model\UpdateIpRequest**](../Model/UpdateIpRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1UpdateIpResponse**](../Model/ScalewayInstanceV1UpdateIpResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
