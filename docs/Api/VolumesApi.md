# OpenAPI\Client\VolumesApi

All URIs are relative to https://api.scaleway.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**applyBlockMigration()**](VolumesApi.md#applyBlockMigration) | **POST** /instance/v1/zones/{zone}/block-migration/apply | Migrate a volume and/or snapshots to SBS (Scaleway Block Storage) |
| [**createVolume()**](VolumesApi.md#createVolume) | **POST** /instance/v1/zones/{zone}/volumes | Create a volume |
| [**deleteVolume()**](VolumesApi.md#deleteVolume) | **DELETE** /instance/v1/zones/{zone}/volumes/{volume_id} | Delete a volume |
| [**getVolume()**](VolumesApi.md#getVolume) | **GET** /instance/v1/zones/{zone}/volumes/{volume_id} | Get a volume |
| [**listVolumes()**](VolumesApi.md#listVolumes) | **GET** /instance/v1/zones/{zone}/volumes | List volumes |
| [**planBlockMigration()**](VolumesApi.md#planBlockMigration) | **POST** /instance/v1/zones/{zone}/block-migration/plan | Get a volume or snapshot&#39;s migration plan |
| [**setVolume()**](VolumesApi.md#setVolume) | **PUT** /instance/v1/zones/{zone}/volumes/{id} | Update volume |
| [**updateVolume()**](VolumesApi.md#updateVolume) | **PATCH** /instance/v1/zones/{zone}/volumes/{volume_id} | Update a volume |


## `applyBlockMigration()`

```php
applyBlockMigration($zone, $apply_block_migration_request)
```

Migrate a volume and/or snapshots to SBS (Scaleway Block Storage)

To be used, this RPC must be preceded by a call to PlanBlockMigration. To migrate all resources mentioned in the MigrationPlan, the validation_key returned in the MigrationPlan must be provided.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\VolumesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$apply_block_migration_request = new \OpenAPI\Client\Model\ApplyBlockMigrationRequest(); // \OpenAPI\Client\Model\ApplyBlockMigrationRequest

try {
    $apiInstance->applyBlockMigration($zone, $apply_block_migration_request);
} catch (Exception $e) {
    echo 'Exception when calling VolumesApi->applyBlockMigration: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **apply_block_migration_request** | [**\OpenAPI\Client\Model\ApplyBlockMigrationRequest**](../Model/ApplyBlockMigrationRequest.md)|  | |

### Return type

void (empty response body)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createVolume()`

```php
createVolume($zone, $create_volume_request): \OpenAPI\Client\Model\ScalewayInstanceV1CreateVolumeResponse
```

Create a volume

Create a volume of a specified type in an Availability Zone.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\VolumesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$create_volume_request = new \OpenAPI\Client\Model\CreateVolumeRequest(); // \OpenAPI\Client\Model\CreateVolumeRequest

try {
    $result = $apiInstance->createVolume($zone, $create_volume_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolumesApi->createVolume: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **create_volume_request** | [**\OpenAPI\Client\Model\CreateVolumeRequest**](../Model/CreateVolumeRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1CreateVolumeResponse**](../Model/ScalewayInstanceV1CreateVolumeResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteVolume()`

```php
deleteVolume($zone, $volume_id)
```

Delete a volume

Delete the volume with the specified ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\VolumesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$volume_id = 'volume_id_example'; // string | UUID of the volume you want to delete.

try {
    $apiInstance->deleteVolume($zone, $volume_id);
} catch (Exception $e) {
    echo 'Exception when calling VolumesApi->deleteVolume: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **volume_id** | **string**| UUID of the volume you want to delete. | |

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

## `getVolume()`

```php
getVolume($zone, $volume_id): \OpenAPI\Client\Model\ScalewayInstanceV1GetVolumeResponse
```

Get a volume

Get details of a volume with the specified ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\VolumesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$volume_id = 'volume_id_example'; // string | UUID of the volume you want to get.

try {
    $result = $apiInstance->getVolume($zone, $volume_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolumesApi->getVolume: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **volume_id** | **string**| UUID of the volume you want to get. | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1GetVolumeResponse**](../Model/ScalewayInstanceV1GetVolumeResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listVolumes()`

```php
listVolumes($zone, $volume_type, $per_page, $page, $organization, $project, $tags, $name): \OpenAPI\Client\Model\ScalewayInstanceV1ListVolumesResponse
```

List volumes

List volumes in the specified Availability Zone. You can filter the output by volume type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\VolumesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$volume_type = 'l_ssd'; // string | Filter by volume type.
$per_page = 56; // int | A positive integer lower or equal to 100 to select the number of items to return.
$page = 1; // int | A positive integer to choose the page to return.
$organization = 'organization_example'; // string | Filter volume by Organization ID.
$project = 'project_example'; // string | Filter volume by Project ID.
$tags = 'tags_example'; // string | Filter volumes with these exact tags (to filter with several tags, use commas to separate them).
$name = 'name_example'; // string | Filter volume by name (for eg. \"vol\" will return \"myvolume\" but not \"data\").

try {
    $result = $apiInstance->listVolumes($zone, $volume_type, $per_page, $page, $organization, $project, $tags, $name);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolumesApi->listVolumes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **volume_type** | **string**| Filter by volume type. | [optional] [default to &#39;l_ssd&#39;] |
| **per_page** | **int**| A positive integer lower or equal to 100 to select the number of items to return. | [optional] |
| **page** | **int**| A positive integer to choose the page to return. | [optional] [default to 1] |
| **organization** | **string**| Filter volume by Organization ID. | [optional] |
| **project** | **string**| Filter volume by Project ID. | [optional] |
| **tags** | **string**| Filter volumes with these exact tags (to filter with several tags, use commas to separate them). | [optional] |
| **name** | **string**| Filter volume by name (for eg. \&quot;vol\&quot; will return \&quot;myvolume\&quot; but not \&quot;data\&quot;). | [optional] |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1ListVolumesResponse**](../Model/ScalewayInstanceV1ListVolumesResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `planBlockMigration()`

```php
planBlockMigration($zone, $plan_block_migration_request): \OpenAPI\Client\Model\ScalewayInstanceV1MigrationPlan
```

Get a volume or snapshot's migration plan

Given a volume or snapshot, returns the migration plan for a call to the RPC ApplyBlockMigration. This plan will include zero or one volume, and zero or more snapshots, which will need to be migrated together. This RPC does not perform the actual migration itself, ApplyBlockMigration must be used. The validation_key value returned by this call must be provided to the ApplyBlockMigration call to confirm that all resources listed in the plan should be migrated.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\VolumesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$plan_block_migration_request = new \OpenAPI\Client\Model\PlanBlockMigrationRequest(); // \OpenAPI\Client\Model\PlanBlockMigrationRequest

try {
    $result = $apiInstance->planBlockMigration($zone, $plan_block_migration_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolumesApi->planBlockMigration: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **plan_block_migration_request** | [**\OpenAPI\Client\Model\PlanBlockMigrationRequest**](../Model/PlanBlockMigrationRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1MigrationPlan**](../Model/ScalewayInstanceV1MigrationPlan.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setVolume()`

```php
setVolume($zone, $id, $set_volume_request): \OpenAPI\Client\Model\ScalewayInstanceV1SetVolumeResponse
```

Update volume

Replace all volume properties with a volume message.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\VolumesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$id = 'id_example'; // string | Unique ID of the volume.
$set_volume_request = new \OpenAPI\Client\Model\SetVolumeRequest(); // \OpenAPI\Client\Model\SetVolumeRequest

try {
    $result = $apiInstance->setVolume($zone, $id, $set_volume_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolumesApi->setVolume: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **id** | **string**| Unique ID of the volume. | |
| **set_volume_request** | [**\OpenAPI\Client\Model\SetVolumeRequest**](../Model/SetVolumeRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1SetVolumeResponse**](../Model/ScalewayInstanceV1SetVolumeResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateVolume()`

```php
updateVolume($zone, $volume_id, $update_volume_request): \OpenAPI\Client\Model\ScalewayInstanceV1UpdateVolumeResponse
```

Update a volume

Replace the name and/or size properties of a volume specified by its ID, with the specified value(s). Any volume name can be changed, however only `b_ssd` volumes can currently be increased in size.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\VolumesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$volume_id = 'volume_id_example'; // string | UUID of the volume.
$update_volume_request = new \OpenAPI\Client\Model\UpdateVolumeRequest(); // \OpenAPI\Client\Model\UpdateVolumeRequest

try {
    $result = $apiInstance->updateVolume($zone, $volume_id, $update_volume_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VolumesApi->updateVolume: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **volume_id** | **string**| UUID of the volume. | |
| **update_volume_request** | [**\OpenAPI\Client\Model\UpdateVolumeRequest**](../Model/UpdateVolumeRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1UpdateVolumeResponse**](../Model/ScalewayInstanceV1UpdateVolumeResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
