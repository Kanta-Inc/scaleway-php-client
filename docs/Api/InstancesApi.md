# OpenAPI\Client\InstancesApi

All URIs are relative to https://api.scaleway.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createServer()**](InstancesApi.md#createServer) | **POST** /instance/v1/zones/{zone}/servers | Create an Instance |
| [**deleteServer()**](InstancesApi.md#deleteServer) | **DELETE** /instance/v1/zones/{zone}/servers/{server_id} | Delete an Instance |
| [**getServer()**](InstancesApi.md#getServer) | **GET** /instance/v1/zones/{zone}/servers/{server_id} | Get an Instance |
| [**listServerActions()**](InstancesApi.md#listServerActions) | **GET** /instance/v1/zones/{zone}/servers/{server_id}/action | List Instance actions |
| [**listServers()**](InstancesApi.md#listServers) | **GET** /instance/v1/zones/{zone}/servers | List all Instances |
| [**serverAction()**](InstancesApi.md#serverAction) | **POST** /instance/v1/zones/{zone}/servers/{server_id}/action | Perform action |
| [**updateServer()**](InstancesApi.md#updateServer) | **PATCH** /instance/v1/zones/{zone}/servers/{server_id} | Update an Instance |


## `createServer()`

```php
createServer($zone, $create_server_request): \OpenAPI\Client\Model\ScalewayInstanceV1CreateServerResponse
```

Create an Instance

Create a new Instance of the specified commercial type in the specified zone. Pay attention to the volumes parameter, which takes an object which can be used in different ways to achieve different behaviors. Get more information in the [Technical Information](#technical-information) section of the introduction.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$create_server_request = new \OpenAPI\Client\Model\CreateServerRequest(); // \OpenAPI\Client\Model\CreateServerRequest

try {
    $result = $apiInstance->createServer($zone, $create_server_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->createServer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **create_server_request** | [**\OpenAPI\Client\Model\CreateServerRequest**](../Model/CreateServerRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1CreateServerResponse**](../Model/ScalewayInstanceV1CreateServerResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteServer()`

```php
deleteServer($zone, $server_id)
```

Delete an Instance

Delete the Instance with the specified ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$server_id = 'server_id_example'; // string

try {
    $apiInstance->deleteServer($zone, $server_id);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->deleteServer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **server_id** | **string**|  | |

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

## `getServer()`

```php
getServer($zone, $server_id): \OpenAPI\Client\Model\ScalewayInstanceV1GetServerResponse
```

Get an Instance

Get the details of a specified Instance.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$server_id = 'server_id_example'; // string | UUID of the Instance you want to get.

try {
    $result = $apiInstance->getServer($zone, $server_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->getServer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **server_id** | **string**| UUID of the Instance you want to get. | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1GetServerResponse**](../Model/ScalewayInstanceV1GetServerResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listServerActions()`

```php
listServerActions($zone, $server_id): \OpenAPI\Client\Model\ScalewayInstanceV1ListServerActionsResponse
```

List Instance actions

List all actions (e.g. power on, power off, reboot) that can currently be performed on an Instance.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$server_id = 'server_id_example'; // string

try {
    $result = $apiInstance->listServerActions($zone, $server_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->listServerActions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **server_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1ListServerActionsResponse**](../Model/ScalewayInstanceV1ListServerActionsResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listServers()`

```php
listServers($zone, $per_page, $page, $organization, $project, $name, $private_ip, $without_ip, $commercial_type, $state, $tags, $private_network, $order, $private_networks, $private_nic_mac_address, $servers): \OpenAPI\Client\Model\ScalewayInstanceV1ListServersResponse
```

List all Instances

List all Instances in a specified Availability Zone, e.g. `fr-par-1`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$per_page = 56; // int | A positive integer lower or equal to 100 to select the number of items to return.
$page = 1; // int | A positive integer to choose the page to return.
$organization = 'organization_example'; // string | List only Instances of this Organization ID.
$project = 'project_example'; // string | List only Instances of this Project ID.
$name = 'name_example'; // string | Filter Instances by name (eg. \"server1\" will return \"server100\" and \"server1\" but not \"foo\").
$private_ip = 1.2.3.4; // string | List Instances by private_ip. (IP address)
$without_ip = True; // bool | List Instances that are not attached to a public IP.
$commercial_type = 'commercial_type_example'; // string | List Instances of this commercial type.
$state = 'running'; // string | List Instances in this state.
$tags = 'tags_example'; // string | List Instances with these exact tags (to filter with several tags, use commas to separate them).
$private_network = 'private_network_example'; // string | List Instances in this Private Network.
$order = 'creation_date_desc'; // string | Define the order of the returned servers.
$private_networks = 'private_networks_example'; // string | List Instances from the given Private Networks (use commas to separate them).
$private_nic_mac_address = 'private_nic_mac_address_example'; // string | List Instances associated with the given private NIC MAC address.
$servers = 'servers_example'; // string | List Instances from these server ids (use commas to separate them).

try {
    $result = $apiInstance->listServers($zone, $per_page, $page, $organization, $project, $name, $private_ip, $without_ip, $commercial_type, $state, $tags, $private_network, $order, $private_networks, $private_nic_mac_address, $servers);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->listServers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **per_page** | **int**| A positive integer lower or equal to 100 to select the number of items to return. | [optional] |
| **page** | **int**| A positive integer to choose the page to return. | [optional] [default to 1] |
| **organization** | **string**| List only Instances of this Organization ID. | [optional] |
| **project** | **string**| List only Instances of this Project ID. | [optional] |
| **name** | **string**| Filter Instances by name (eg. \&quot;server1\&quot; will return \&quot;server100\&quot; and \&quot;server1\&quot; but not \&quot;foo\&quot;). | [optional] |
| **private_ip** | **string**| List Instances by private_ip. (IP address) | [optional] |
| **without_ip** | **bool**| List Instances that are not attached to a public IP. | [optional] |
| **commercial_type** | **string**| List Instances of this commercial type. | [optional] |
| **state** | **string**| List Instances in this state. | [optional] [default to &#39;running&#39;] |
| **tags** | **string**| List Instances with these exact tags (to filter with several tags, use commas to separate them). | [optional] |
| **private_network** | **string**| List Instances in this Private Network. | [optional] |
| **order** | **string**| Define the order of the returned servers. | [optional] [default to &#39;creation_date_desc&#39;] |
| **private_networks** | **string**| List Instances from the given Private Networks (use commas to separate them). | [optional] |
| **private_nic_mac_address** | **string**| List Instances associated with the given private NIC MAC address. | [optional] |
| **servers** | **string**| List Instances from these server ids (use commas to separate them). | [optional] |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1ListServersResponse**](../Model/ScalewayInstanceV1ListServersResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `serverAction()`

```php
serverAction($zone, $server_id, $server_action_request): \OpenAPI\Client\Model\ScalewayInstanceV1ServerActionResponse
```

Perform action

Perform an action on an Instance. Available actions are: * `poweron`: Start a stopped Instance. * `poweroff`: Fully stop the Instance and release the hypervisor slot. * `stop_in_place`: Stop the Instance, but keep the slot on the hypervisor. * `reboot`: Stop the instance and restart it. * `backup`:  Create an image with all the volumes of an Instance. * `terminate`: Delete the Instance along with all attached volumes. * `enable_routed_ip`: Migrate the Instance to the new network stack.  Keep in mind that terminating an Instance will result in the deletion of all attached volumes, including local and block storage. If you want to preserve your local volumes, you should use the `archive` action instead of `terminate`. Similarly, if you want to keep your block storage volumes, you must first detach them before issuing the `terminate` command. For more information, read the [Volumes](#path-volumes-list-volumes) documentation.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$server_id = 'server_id_example'; // string | UUID of the Instance.
$server_action_request = new \OpenAPI\Client\Model\ServerActionRequest(); // \OpenAPI\Client\Model\ServerActionRequest

try {
    $result = $apiInstance->serverAction($zone, $server_id, $server_action_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->serverAction: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **server_id** | **string**| UUID of the Instance. | |
| **server_action_request** | [**\OpenAPI\Client\Model\ServerActionRequest**](../Model/ServerActionRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1ServerActionResponse**](../Model/ScalewayInstanceV1ServerActionResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateServer()`

```php
updateServer($zone, $server_id, $update_server_request): \OpenAPI\Client\Model\ScalewayInstanceV1UpdateServerResponse
```

Update an Instance

Update the Instance information, such as name, boot mode, or tags.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\InstancesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$server_id = 'server_id_example'; // string | UUID of the Instance.
$update_server_request = new \OpenAPI\Client\Model\UpdateServerRequest(); // \OpenAPI\Client\Model\UpdateServerRequest

try {
    $result = $apiInstance->updateServer($zone, $server_id, $update_server_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling InstancesApi->updateServer: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **server_id** | **string**| UUID of the Instance. | |
| **update_server_request** | [**\OpenAPI\Client\Model\UpdateServerRequest**](../Model/UpdateServerRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1UpdateServerResponse**](../Model/ScalewayInstanceV1UpdateServerResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
