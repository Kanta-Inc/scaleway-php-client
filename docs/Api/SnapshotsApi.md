# OpenAPI\Client\SnapshotsApi

All URIs are relative to https://api.scaleway.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createSnapshot()**](SnapshotsApi.md#createSnapshot) | **POST** /instance/v1/zones/{zone}/snapshots | Create a snapshot from a specified volume or from a QCOW2 file |
| [**deleteSnapshot()**](SnapshotsApi.md#deleteSnapshot) | **DELETE** /instance/v1/zones/{zone}/snapshots/{snapshot_id} | Delete a snapshot |
| [**exportSnapshot()**](SnapshotsApi.md#exportSnapshot) | **POST** /instance/v1/zones/{zone}/snapshots/{snapshot_id}/export | Export a snapshot |
| [**getSnapshot()**](SnapshotsApi.md#getSnapshot) | **GET** /instance/v1/zones/{zone}/snapshots/{snapshot_id} | Get a snapshot |
| [**listSnapshots()**](SnapshotsApi.md#listSnapshots) | **GET** /instance/v1/zones/{zone}/snapshots | List snapshots |
| [**setSnapshot()**](SnapshotsApi.md#setSnapshot) | **PUT** /instance/v1/zones/{zone}/snapshots/{snapshot_id} | Set snapshot |
| [**updateSnapshot()**](SnapshotsApi.md#updateSnapshot) | **PATCH** /instance/v1/zones/{zone}/snapshots/{snapshot_id} | Update a snapshot |


## `createSnapshot()`

```php
createSnapshot($zone, $create_snapshot_request): \OpenAPI\Client\Model\ScalewayInstanceV1CreateSnapshotResponse
```

Create a snapshot from a specified volume or from a QCOW2 file

Create a snapshot from a specified volume or from a QCOW2 file in a specified Availability Zone.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$create_snapshot_request = new \OpenAPI\Client\Model\CreateSnapshotRequest(); // \OpenAPI\Client\Model\CreateSnapshotRequest

try {
    $result = $apiInstance->createSnapshot($zone, $create_snapshot_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->createSnapshot: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **create_snapshot_request** | [**\OpenAPI\Client\Model\CreateSnapshotRequest**](../Model/CreateSnapshotRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1CreateSnapshotResponse**](../Model/ScalewayInstanceV1CreateSnapshotResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteSnapshot()`

```php
deleteSnapshot($zone, $snapshot_id)
```

Delete a snapshot

Delete the snapshot with the specified ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$snapshot_id = 'snapshot_id_example'; // string | UUID of the snapshot you want to delete.

try {
    $apiInstance->deleteSnapshot($zone, $snapshot_id);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->deleteSnapshot: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **snapshot_id** | **string**| UUID of the snapshot you want to delete. | |

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

## `exportSnapshot()`

```php
exportSnapshot($zone, $snapshot_id, $export_snapshot_request): \OpenAPI\Client\Model\ScalewayInstanceV1ExportSnapshotResponse
```

Export a snapshot

Export a snapshot to a specified S3 bucket in the same region.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$snapshot_id = 'snapshot_id_example'; // string | Snapshot ID.
$export_snapshot_request = new \OpenAPI\Client\Model\ExportSnapshotRequest(); // \OpenAPI\Client\Model\ExportSnapshotRequest

try {
    $result = $apiInstance->exportSnapshot($zone, $snapshot_id, $export_snapshot_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->exportSnapshot: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **snapshot_id** | **string**| Snapshot ID. | |
| **export_snapshot_request** | [**\OpenAPI\Client\Model\ExportSnapshotRequest**](../Model/ExportSnapshotRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1ExportSnapshotResponse**](../Model/ScalewayInstanceV1ExportSnapshotResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getSnapshot()`

```php
getSnapshot($zone, $snapshot_id): \OpenAPI\Client\Model\ScalewayInstanceV1GetSnapshotResponse
```

Get a snapshot

Get details of a snapshot with the specified ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$snapshot_id = 'snapshot_id_example'; // string | UUID of the snapshot you want to get.

try {
    $result = $apiInstance->getSnapshot($zone, $snapshot_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->getSnapshot: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **snapshot_id** | **string**| UUID of the snapshot you want to get. | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1GetSnapshotResponse**](../Model/ScalewayInstanceV1GetSnapshotResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listSnapshots()`

```php
listSnapshots($zone, $organization, $project, $per_page, $page, $name, $tags, $base_volume_id): \OpenAPI\Client\Model\ScalewayInstanceV1ListSnapshotsResponse
```

List snapshots

List all snapshots of an Organization in a specified Availability Zone.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$organization = 'organization_example'; // string | List snapshots only for this Organization ID.
$project = 'project_example'; // string | List snapshots only for this Project ID.
$per_page = 56; // int | Number of snapshots returned per page (positive integer lower or equal to 100).
$page = 1; // int | Page to be returned.
$name = 'name_example'; // string | List snapshots of the requested name.
$tags = 'tags_example'; // string | List snapshots that have the requested tag.
$base_volume_id = 'base_volume_id_example'; // string | List snapshots originating only from this volume.

try {
    $result = $apiInstance->listSnapshots($zone, $organization, $project, $per_page, $page, $name, $tags, $base_volume_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->listSnapshots: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **organization** | **string**| List snapshots only for this Organization ID. | [optional] |
| **project** | **string**| List snapshots only for this Project ID. | [optional] |
| **per_page** | **int**| Number of snapshots returned per page (positive integer lower or equal to 100). | [optional] |
| **page** | **int**| Page to be returned. | [optional] [default to 1] |
| **name** | **string**| List snapshots of the requested name. | [optional] |
| **tags** | **string**| List snapshots that have the requested tag. | [optional] |
| **base_volume_id** | **string**| List snapshots originating only from this volume. | [optional] |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1ListSnapshotsResponse**](../Model/ScalewayInstanceV1ListSnapshotsResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setSnapshot()`

```php
setSnapshot($zone, $snapshot_id, $set_snapshot_request): \OpenAPI\Client\Model\ScalewayInstanceV1SetSnapshotResponse
```

Set snapshot

Replace all the properties of a snapshot.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$snapshot_id = 'snapshot_id_example'; // string
$set_snapshot_request = new \OpenAPI\Client\Model\SetSnapshotRequest(); // \OpenAPI\Client\Model\SetSnapshotRequest

try {
    $result = $apiInstance->setSnapshot($zone, $snapshot_id, $set_snapshot_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->setSnapshot: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **snapshot_id** | **string**|  | |
| **set_snapshot_request** | [**\OpenAPI\Client\Model\SetSnapshotRequest**](../Model/SetSnapshotRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1SetSnapshotResponse**](../Model/ScalewayInstanceV1SetSnapshotResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateSnapshot()`

```php
updateSnapshot($zone, $snapshot_id, $update_snapshot_request): \OpenAPI\Client\Model\ScalewayInstanceV1UpdateSnapshotResponse
```

Update a snapshot

Update the properties of a snapshot.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SnapshotsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$snapshot_id = 6170692e-7363-616c-6577-61792e636f6d; // string | UUID of the snapshot. (UUID format)
$update_snapshot_request = new \OpenAPI\Client\Model\UpdateSnapshotRequest(); // \OpenAPI\Client\Model\UpdateSnapshotRequest

try {
    $result = $apiInstance->updateSnapshot($zone, $snapshot_id, $update_snapshot_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SnapshotsApi->updateSnapshot: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **snapshot_id** | **string**| UUID of the snapshot. (UUID format) | |
| **update_snapshot_request** | [**\OpenAPI\Client\Model\UpdateSnapshotRequest**](../Model/UpdateSnapshotRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1UpdateSnapshotResponse**](../Model/ScalewayInstanceV1UpdateSnapshotResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
