# OpenAPI\Client\PlacementGroupsApi

All URIs are relative to https://api.scaleway.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createPlacementGroup()**](PlacementGroupsApi.md#createPlacementGroup) | **POST** /instance/v1/zones/{zone}/placement_groups | Create a placement group |
| [**deletePlacementGroup()**](PlacementGroupsApi.md#deletePlacementGroup) | **DELETE** /instance/v1/zones/{zone}/placement_groups/{placement_group_id} | Delete the specified placement group |
| [**getPlacementGroup()**](PlacementGroupsApi.md#getPlacementGroup) | **GET** /instance/v1/zones/{zone}/placement_groups/{placement_group_id} | Get a placement group |
| [**getPlacementGroupServers()**](PlacementGroupsApi.md#getPlacementGroupServers) | **GET** /instance/v1/zones/{zone}/placement_groups/{placement_group_id}/servers | Get placement group servers |
| [**listPlacementGroups()**](PlacementGroupsApi.md#listPlacementGroups) | **GET** /instance/v1/zones/{zone}/placement_groups | List placement groups |
| [**setPlacementGroup()**](PlacementGroupsApi.md#setPlacementGroup) | **PUT** /instance/v1/zones/{zone}/placement_groups/{placement_group_id} | Set placement group |
| [**setPlacementGroupServers()**](PlacementGroupsApi.md#setPlacementGroupServers) | **PUT** /instance/v1/zones/{zone}/placement_groups/{placement_group_id}/servers | Set placement group servers |
| [**updatePlacementGroup()**](PlacementGroupsApi.md#updatePlacementGroup) | **PATCH** /instance/v1/zones/{zone}/placement_groups/{placement_group_id} | Update a placement group |
| [**updatePlacementGroupServers()**](PlacementGroupsApi.md#updatePlacementGroupServers) | **PATCH** /instance/v1/zones/{zone}/placement_groups/{placement_group_id}/servers | Update placement group servers |


## `createPlacementGroup()`

```php
createPlacementGroup($zone, $create_placement_group_request): \OpenAPI\Client\Model\ScalewayInstanceV1CreatePlacementGroupResponse
```

Create a placement group

Create a new placement group in a specified Availability Zone.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PlacementGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$create_placement_group_request = new \OpenAPI\Client\Model\CreatePlacementGroupRequest(); // \OpenAPI\Client\Model\CreatePlacementGroupRequest

try {
    $result = $apiInstance->createPlacementGroup($zone, $create_placement_group_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PlacementGroupsApi->createPlacementGroup: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **create_placement_group_request** | [**\OpenAPI\Client\Model\CreatePlacementGroupRequest**](../Model/CreatePlacementGroupRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1CreatePlacementGroupResponse**](../Model/ScalewayInstanceV1CreatePlacementGroupResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deletePlacementGroup()`

```php
deletePlacementGroup($zone, $placement_group_id)
```

Delete the specified placement group

Delete the specified placement group.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PlacementGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$placement_group_id = 'placement_group_id_example'; // string | UUID of the placement group you want to delete.

try {
    $apiInstance->deletePlacementGroup($zone, $placement_group_id);
} catch (Exception $e) {
    echo 'Exception when calling PlacementGroupsApi->deletePlacementGroup: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **placement_group_id** | **string**| UUID of the placement group you want to delete. | |

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

## `getPlacementGroup()`

```php
getPlacementGroup($zone, $placement_group_id): \OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupResponse
```

Get a placement group

Get the specified placement group.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PlacementGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$placement_group_id = 'placement_group_id_example'; // string | UUID of the placement group you want to get.

try {
    $result = $apiInstance->getPlacementGroup($zone, $placement_group_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PlacementGroupsApi->getPlacementGroup: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **placement_group_id** | **string**| UUID of the placement group you want to get. | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupResponse**](../Model/ScalewayInstanceV1GetPlacementGroupResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPlacementGroupServers()`

```php
getPlacementGroupServers($zone, $placement_group_id): \OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupServersResponse
```

Get placement group servers

Get all Instances belonging to the specified placement group.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PlacementGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$placement_group_id = 'placement_group_id_example'; // string | UUID of the placement group you want to get.

try {
    $result = $apiInstance->getPlacementGroupServers($zone, $placement_group_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PlacementGroupsApi->getPlacementGroupServers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **placement_group_id** | **string**| UUID of the placement group you want to get. | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupServersResponse**](../Model/ScalewayInstanceV1GetPlacementGroupServersResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listPlacementGroups()`

```php
listPlacementGroups($zone, $per_page, $page, $organization, $project, $tags, $name): \OpenAPI\Client\Model\ScalewayInstanceV1ListPlacementGroupsResponse
```

List placement groups

List all placement groups in a specified Availability Zone.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PlacementGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$per_page = 56; // int | A positive integer lower or equal to 100 to select the number of items to return.
$page = 1; // int | A positive integer to choose the page to return.
$organization = 'organization_example'; // string | List only placement groups of this Organization ID.
$project = 'project_example'; // string | List only placement groups of this Project ID.
$tags = 'tags_example'; // string | List placement groups with these exact tags (to filter with several tags, use commas to separate them).
$name = 'name_example'; // string | Filter placement groups by name (for eg. \"cluster1\" will return \"cluster100\" and \"cluster1\" but not \"foo\").

try {
    $result = $apiInstance->listPlacementGroups($zone, $per_page, $page, $organization, $project, $tags, $name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PlacementGroupsApi->listPlacementGroups: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **per_page** | **int**| A positive integer lower or equal to 100 to select the number of items to return. | [optional] |
| **page** | **int**| A positive integer to choose the page to return. | [optional] [default to 1] |
| **organization** | **string**| List only placement groups of this Organization ID. | [optional] |
| **project** | **string**| List only placement groups of this Project ID. | [optional] |
| **tags** | **string**| List placement groups with these exact tags (to filter with several tags, use commas to separate them). | [optional] |
| **name** | **string**| Filter placement groups by name (for eg. \&quot;cluster1\&quot; will return \&quot;cluster100\&quot; and \&quot;cluster1\&quot; but not \&quot;foo\&quot;). | [optional] |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1ListPlacementGroupsResponse**](../Model/ScalewayInstanceV1ListPlacementGroupsResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setPlacementGroup()`

```php
setPlacementGroup($zone, $placement_group_id, $set_placement_group_request): \OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupResponse
```

Set placement group

Set all parameters of the specified placement group.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PlacementGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$placement_group_id = 'placement_group_id_example'; // string
$set_placement_group_request = new \OpenAPI\Client\Model\SetPlacementGroupRequest(); // \OpenAPI\Client\Model\SetPlacementGroupRequest

try {
    $result = $apiInstance->setPlacementGroup($zone, $placement_group_id, $set_placement_group_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PlacementGroupsApi->setPlacementGroup: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **placement_group_id** | **string**|  | |
| **set_placement_group_request** | [**\OpenAPI\Client\Model\SetPlacementGroupRequest**](../Model/SetPlacementGroupRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupResponse**](../Model/ScalewayInstanceV1SetPlacementGroupResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setPlacementGroupServers()`

```php
setPlacementGroupServers($zone, $placement_group_id, $set_placement_group_servers_request): \OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupServersResponse
```

Set placement group servers

Set all Instances belonging to the specified placement group.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PlacementGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$placement_group_id = 'placement_group_id_example'; // string | UUID of the placement group you want to set.
$set_placement_group_servers_request = new \OpenAPI\Client\Model\SetPlacementGroupServersRequest(); // \OpenAPI\Client\Model\SetPlacementGroupServersRequest

try {
    $result = $apiInstance->setPlacementGroupServers($zone, $placement_group_id, $set_placement_group_servers_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PlacementGroupsApi->setPlacementGroupServers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **placement_group_id** | **string**| UUID of the placement group you want to set. | |
| **set_placement_group_servers_request** | [**\OpenAPI\Client\Model\SetPlacementGroupServersRequest**](../Model/SetPlacementGroupServersRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupServersResponse**](../Model/ScalewayInstanceV1SetPlacementGroupServersResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updatePlacementGroup()`

```php
updatePlacementGroup($zone, $placement_group_id, $update_placement_group_request): \OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupResponse
```

Update a placement group

Update one or more parameter of the specified placement group.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PlacementGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$placement_group_id = 'placement_group_id_example'; // string | UUID of the placement group.
$update_placement_group_request = new \OpenAPI\Client\Model\UpdatePlacementGroupRequest(); // \OpenAPI\Client\Model\UpdatePlacementGroupRequest

try {
    $result = $apiInstance->updatePlacementGroup($zone, $placement_group_id, $update_placement_group_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PlacementGroupsApi->updatePlacementGroup: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **placement_group_id** | **string**| UUID of the placement group. | |
| **update_placement_group_request** | [**\OpenAPI\Client\Model\UpdatePlacementGroupRequest**](../Model/UpdatePlacementGroupRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupResponse**](../Model/ScalewayInstanceV1UpdatePlacementGroupResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updatePlacementGroupServers()`

```php
updatePlacementGroupServers($zone, $placement_group_id, $set_placement_group_servers_request): \OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupServersResponse
```

Update placement group servers

Update all Instances belonging to the specified placement group.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\PlacementGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$placement_group_id = 'placement_group_id_example'; // string | UUID of the placement group you want to update.
$set_placement_group_servers_request = new \OpenAPI\Client\Model\SetPlacementGroupServersRequest(); // \OpenAPI\Client\Model\SetPlacementGroupServersRequest

try {
    $result = $apiInstance->updatePlacementGroupServers($zone, $placement_group_id, $set_placement_group_servers_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PlacementGroupsApi->updatePlacementGroupServers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **placement_group_id** | **string**| UUID of the placement group you want to update. | |
| **set_placement_group_servers_request** | [**\OpenAPI\Client\Model\SetPlacementGroupServersRequest**](../Model/SetPlacementGroupServersRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupServersResponse**](../Model/ScalewayInstanceV1UpdatePlacementGroupServersResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
