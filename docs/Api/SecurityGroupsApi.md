# OpenAPI\Client\SecurityGroupsApi

All URIs are relative to https://api.scaleway.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createSecurityGroup()**](SecurityGroupsApi.md#createSecurityGroup) | **POST** /instance/v1/zones/{zone}/security_groups | Create a security group |
| [**createSecurityGroupRule()**](SecurityGroupsApi.md#createSecurityGroupRule) | **POST** /instance/v1/zones/{zone}/security_groups/{security_group_id}/rules | Create rule |
| [**deleteSecurityGroup()**](SecurityGroupsApi.md#deleteSecurityGroup) | **DELETE** /instance/v1/zones/{zone}/security_groups/{security_group_id} | Delete a security group |
| [**deleteSecurityGroupRule()**](SecurityGroupsApi.md#deleteSecurityGroupRule) | **DELETE** /instance/v1/zones/{zone}/security_groups/{security_group_id}/rules/{security_group_rule_id} | Delete rule |
| [**getSecurityGroup()**](SecurityGroupsApi.md#getSecurityGroup) | **GET** /instance/v1/zones/{zone}/security_groups/{security_group_id} | Get a security group |
| [**getSecurityGroupRule()**](SecurityGroupsApi.md#getSecurityGroupRule) | **GET** /instance/v1/zones/{zone}/security_groups/{security_group_id}/rules/{security_group_rule_id} | Get rule |
| [**listDefaultSecurityGroupRules()**](SecurityGroupsApi.md#listDefaultSecurityGroupRules) | **GET** /instance/v1/zones/{zone}/security_groups/default/rules | Get default rules |
| [**listSecurityGroupRules()**](SecurityGroupsApi.md#listSecurityGroupRules) | **GET** /instance/v1/zones/{zone}/security_groups/{security_group_id}/rules | List rules |
| [**listSecurityGroups()**](SecurityGroupsApi.md#listSecurityGroups) | **GET** /instance/v1/zones/{zone}/security_groups | List security groups |
| [**setSecurityGroup()**](SecurityGroupsApi.md#setSecurityGroup) | **PUT** /instance/v1/zones/{zone}/security_groups/{id} | Update a security group |
| [**setSecurityGroupRule()**](SecurityGroupsApi.md#setSecurityGroupRule) | **PUT** /instance/v1/zones/{zone}/security_groups/{security_group_id}/rules/{security_group_rule_id} | Set security group rule |
| [**setSecurityGroupRules()**](SecurityGroupsApi.md#setSecurityGroupRules) | **PUT** /instance/v1/zones/{zone}/security_groups/{security_group_id}/rules | Update all the rules of a security group |
| [**updateSecurityGroup()**](SecurityGroupsApi.md#updateSecurityGroup) | **PATCH** /instance/v1/zones/{zone}/security_groups/{security_group_id} | Update a security group |
| [**updateSecurityGroupRule()**](SecurityGroupsApi.md#updateSecurityGroupRule) | **PATCH** /instance/v1/zones/{zone}/security_groups/{security_group_id}/rules/{security_group_rule_id} | Update security group rule |


## `createSecurityGroup()`

```php
createSecurityGroup($zone, $create_security_group_request): \OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupResponse
```

Create a security group

Create a security group with a specified name and description.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SecurityGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$create_security_group_request = new \OpenAPI\Client\Model\CreateSecurityGroupRequest(); // \OpenAPI\Client\Model\CreateSecurityGroupRequest

try {
    $result = $apiInstance->createSecurityGroup($zone, $create_security_group_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SecurityGroupsApi->createSecurityGroup: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **create_security_group_request** | [**\OpenAPI\Client\Model\CreateSecurityGroupRequest**](../Model/CreateSecurityGroupRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupResponse**](../Model/ScalewayInstanceV1CreateSecurityGroupResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createSecurityGroupRule()`

```php
createSecurityGroupRule($zone, $security_group_id, $create_security_group_rule_request): \OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupRuleResponse
```

Create rule

Create a rule in the specified security group ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SecurityGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$security_group_id = 'security_group_id_example'; // string | UUID of the security group.
$create_security_group_rule_request = new \OpenAPI\Client\Model\CreateSecurityGroupRuleRequest(); // \OpenAPI\Client\Model\CreateSecurityGroupRuleRequest

try {
    $result = $apiInstance->createSecurityGroupRule($zone, $security_group_id, $create_security_group_rule_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SecurityGroupsApi->createSecurityGroupRule: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **security_group_id** | **string**| UUID of the security group. | |
| **create_security_group_rule_request** | [**\OpenAPI\Client\Model\CreateSecurityGroupRuleRequest**](../Model/CreateSecurityGroupRuleRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupRuleResponse**](../Model/ScalewayInstanceV1CreateSecurityGroupRuleResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteSecurityGroup()`

```php
deleteSecurityGroup($zone, $security_group_id)
```

Delete a security group

Delete a security group with the specified ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SecurityGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$security_group_id = 'security_group_id_example'; // string | UUID of the security group you want to delete.

try {
    $apiInstance->deleteSecurityGroup($zone, $security_group_id);
} catch (Exception $e) {
    echo 'Exception when calling SecurityGroupsApi->deleteSecurityGroup: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **security_group_id** | **string**| UUID of the security group you want to delete. | |

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

## `deleteSecurityGroupRule()`

```php
deleteSecurityGroupRule($zone, $security_group_id, $security_group_rule_id)
```

Delete rule

Delete a security group rule with the specified ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SecurityGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$security_group_id = 'security_group_id_example'; // string
$security_group_rule_id = 'security_group_rule_id_example'; // string

try {
    $apiInstance->deleteSecurityGroupRule($zone, $security_group_id, $security_group_rule_id);
} catch (Exception $e) {
    echo 'Exception when calling SecurityGroupsApi->deleteSecurityGroupRule: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **security_group_id** | **string**|  | |
| **security_group_rule_id** | **string**|  | |

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

## `getSecurityGroup()`

```php
getSecurityGroup($zone, $security_group_id): \OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupResponse
```

Get a security group

Get the details of a security group with the specified ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SecurityGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$security_group_id = 'security_group_id_example'; // string | UUID of the security group you want to get.

try {
    $result = $apiInstance->getSecurityGroup($zone, $security_group_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SecurityGroupsApi->getSecurityGroup: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **security_group_id** | **string**| UUID of the security group you want to get. | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupResponse**](../Model/ScalewayInstanceV1GetSecurityGroupResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getSecurityGroupRule()`

```php
getSecurityGroupRule($zone, $security_group_id, $security_group_rule_id): \OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupRuleResponse
```

Get rule

Get details of a security group rule with the specified ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SecurityGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$security_group_id = 'security_group_id_example'; // string
$security_group_rule_id = 'security_group_rule_id_example'; // string

try {
    $result = $apiInstance->getSecurityGroupRule($zone, $security_group_id, $security_group_rule_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SecurityGroupsApi->getSecurityGroupRule: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **security_group_id** | **string**|  | |
| **security_group_rule_id** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupRuleResponse**](../Model/ScalewayInstanceV1GetSecurityGroupRuleResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listDefaultSecurityGroupRules()`

```php
listDefaultSecurityGroupRules($zone): \OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse
```

Get default rules

Lists the default rules applied to all the security groups.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SecurityGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target

try {
    $result = $apiInstance->listDefaultSecurityGroupRules($zone);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SecurityGroupsApi->listDefaultSecurityGroupRules: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse**](../Model/ScalewayInstanceV1ListSecurityGroupRulesResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listSecurityGroupRules()`

```php
listSecurityGroupRules($zone, $security_group_id, $per_page, $page): \OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse
```

List rules

List the rules of the a specified security group ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SecurityGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$security_group_id = 'security_group_id_example'; // string | UUID of the security group.
$per_page = 56; // int | A positive integer lower or equal to 100 to select the number of items to return.
$page = 1; // int | A positive integer to choose the page to return.

try {
    $result = $apiInstance->listSecurityGroupRules($zone, $security_group_id, $per_page, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SecurityGroupsApi->listSecurityGroupRules: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **security_group_id** | **string**| UUID of the security group. | |
| **per_page** | **int**| A positive integer lower or equal to 100 to select the number of items to return. | [optional] |
| **page** | **int**| A positive integer to choose the page to return. | [optional] [default to 1] |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse**](../Model/ScalewayInstanceV1ListSecurityGroupRulesResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listSecurityGroups()`

```php
listSecurityGroups($zone, $name, $organization, $project, $tags, $project_default, $per_page, $page): \OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupsResponse
```

List security groups

List all existing security groups.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SecurityGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$name = 'name_example'; // string | Name of the security group.
$organization = 'organization_example'; // string | Security group Organization ID.
$project = 'project_example'; // string | Security group Project ID.
$tags = 'tags_example'; // string | List security groups with these exact tags (to filter with several tags, use commas to separate them).
$project_default = True; // bool | Filter security groups with this value for project_default.
$per_page = 56; // int | A positive integer lower or equal to 100 to select the number of items to return.
$page = 1; // int | A positive integer to choose the page to return.

try {
    $result = $apiInstance->listSecurityGroups($zone, $name, $organization, $project, $tags, $project_default, $per_page, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SecurityGroupsApi->listSecurityGroups: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **name** | **string**| Name of the security group. | [optional] |
| **organization** | **string**| Security group Organization ID. | [optional] |
| **project** | **string**| Security group Project ID. | [optional] |
| **tags** | **string**| List security groups with these exact tags (to filter with several tags, use commas to separate them). | [optional] |
| **project_default** | **bool**| Filter security groups with this value for project_default. | [optional] |
| **per_page** | **int**| A positive integer lower or equal to 100 to select the number of items to return. | [optional] |
| **page** | **int**| A positive integer to choose the page to return. | [optional] [default to 1] |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupsResponse**](../Model/ScalewayInstanceV1ListSecurityGroupsResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setSecurityGroup()`

```php
setSecurityGroup($zone, $id, $set_security_group_request): \OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupResponse
```

Update a security group

Replace all security group properties with a security group message.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SecurityGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$id = 'id_example'; // string | UUID of the security group.
$set_security_group_request = new \OpenAPI\Client\Model\SetSecurityGroupRequest(); // \OpenAPI\Client\Model\SetSecurityGroupRequest

try {
    $result = $apiInstance->setSecurityGroup($zone, $id, $set_security_group_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SecurityGroupsApi->setSecurityGroup: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **id** | **string**| UUID of the security group. | |
| **set_security_group_request** | [**\OpenAPI\Client\Model\SetSecurityGroupRequest**](../Model/SetSecurityGroupRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupResponse**](../Model/ScalewayInstanceV1SetSecurityGroupResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setSecurityGroupRule()`

```php
setSecurityGroupRule($zone, $security_group_id, $security_group_rule_id, $set_security_group_rule_request): \OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRuleResponse
```

Set security group rule

Replace all the properties of a rule from a specified security group.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SecurityGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$security_group_id = 'security_group_id_example'; // string
$security_group_rule_id = 'security_group_rule_id_example'; // string
$set_security_group_rule_request = new \OpenAPI\Client\Model\SetSecurityGroupRuleRequest(); // \OpenAPI\Client\Model\SetSecurityGroupRuleRequest

try {
    $result = $apiInstance->setSecurityGroupRule($zone, $security_group_id, $security_group_rule_id, $set_security_group_rule_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SecurityGroupsApi->setSecurityGroupRule: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **security_group_id** | **string**|  | |
| **security_group_rule_id** | **string**|  | |
| **set_security_group_rule_request** | [**\OpenAPI\Client\Model\SetSecurityGroupRuleRequest**](../Model/SetSecurityGroupRuleRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRuleResponse**](../Model/ScalewayInstanceV1SetSecurityGroupRuleResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setSecurityGroupRules()`

```php
setSecurityGroupRules($zone, $security_group_id, $set_security_group_rules_request): \OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRulesResponse
```

Update all the rules of a security group

Replaces the existing rules of the security group with the rules provided. This endpoint supports the update of existing rules, creation of new rules and deletion of existing rules when they are not passed in the request.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SecurityGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$security_group_id = 'security_group_id_example'; // string | UUID of the security group to update the rules on.
$set_security_group_rules_request = new \OpenAPI\Client\Model\SetSecurityGroupRulesRequest(); // \OpenAPI\Client\Model\SetSecurityGroupRulesRequest

try {
    $result = $apiInstance->setSecurityGroupRules($zone, $security_group_id, $set_security_group_rules_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SecurityGroupsApi->setSecurityGroupRules: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **security_group_id** | **string**| UUID of the security group to update the rules on. | |
| **set_security_group_rules_request** | [**\OpenAPI\Client\Model\SetSecurityGroupRulesRequest**](../Model/SetSecurityGroupRulesRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRulesResponse**](../Model/ScalewayInstanceV1SetSecurityGroupRulesResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateSecurityGroup()`

```php
updateSecurityGroup($zone, $security_group_id, $update_security_group_request): \OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupResponse
```

Update a security group

Update the properties of security group.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SecurityGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$security_group_id = 6170692e-7363-616c-6577-61792e636f6d; // string | UUID of the security group. (UUID format)
$update_security_group_request = new \OpenAPI\Client\Model\UpdateSecurityGroupRequest(); // \OpenAPI\Client\Model\UpdateSecurityGroupRequest

try {
    $result = $apiInstance->updateSecurityGroup($zone, $security_group_id, $update_security_group_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SecurityGroupsApi->updateSecurityGroup: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **security_group_id** | **string**| UUID of the security group. (UUID format) | |
| **update_security_group_request** | [**\OpenAPI\Client\Model\UpdateSecurityGroupRequest**](../Model/UpdateSecurityGroupRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupResponse**](../Model/ScalewayInstanceV1UpdateSecurityGroupResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateSecurityGroupRule()`

```php
updateSecurityGroupRule($zone, $security_group_id, $security_group_rule_id, $update_security_group_rule_request): \OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupRuleResponse
```

Update security group rule

Update the properties of a rule from a specified security group.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\SecurityGroupsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$security_group_id = 6170692e-7363-616c-6577-61792e636f6d; // string | UUID of the security group. (UUID format)
$security_group_rule_id = 6170692e-7363-616c-6577-61792e636f6d; // string | UUID of the rule. (UUID format)
$update_security_group_rule_request = new \OpenAPI\Client\Model\UpdateSecurityGroupRuleRequest(); // \OpenAPI\Client\Model\UpdateSecurityGroupRuleRequest

try {
    $result = $apiInstance->updateSecurityGroupRule($zone, $security_group_id, $security_group_rule_id, $update_security_group_rule_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SecurityGroupsApi->updateSecurityGroupRule: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **security_group_id** | **string**| UUID of the security group. (UUID format) | |
| **security_group_rule_id** | **string**| UUID of the rule. (UUID format) | |
| **update_security_group_rule_request** | [**\OpenAPI\Client\Model\UpdateSecurityGroupRuleRequest**](../Model/UpdateSecurityGroupRuleRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupRuleResponse**](../Model/ScalewayInstanceV1UpdateSecurityGroupRuleResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
