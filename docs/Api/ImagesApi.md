# OpenAPI\Client\ImagesApi

All URIs are relative to https://api.scaleway.com, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createImage()**](ImagesApi.md#createImage) | **POST** /instance/v1/zones/{zone}/images | Create an Instance image |
| [**deleteImage()**](ImagesApi.md#deleteImage) | **DELETE** /instance/v1/zones/{zone}/images/{image_id} | Delete an Instance image |
| [**getImage()**](ImagesApi.md#getImage) | **GET** /instance/v1/zones/{zone}/images/{image_id} | Get an Instance image |
| [**listImages()**](ImagesApi.md#listImages) | **GET** /instance/v1/zones/{zone}/images | List Instance images |
| [**setImage()**](ImagesApi.md#setImage) | **PUT** /instance/v1/zones/{zone}/images/{id} | Update image |
| [**updateImage()**](ImagesApi.md#updateImage) | **PATCH** /instance/v1/zones/{zone}/images/{image_id} | Update image |


## `createImage()`

```php
createImage($zone, $create_image_request): \OpenAPI\Client\Model\ScalewayInstanceV1CreateImageResponse
```

Create an Instance image

Create an Instance image from the specified snapshot ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$create_image_request = new \OpenAPI\Client\Model\CreateImageRequest(); // \OpenAPI\Client\Model\CreateImageRequest

try {
    $result = $apiInstance->createImage($zone, $create_image_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->createImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **create_image_request** | [**\OpenAPI\Client\Model\CreateImageRequest**](../Model/CreateImageRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1CreateImageResponse**](../Model/ScalewayInstanceV1CreateImageResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteImage()`

```php
deleteImage($zone, $image_id)
```

Delete an Instance image

Delete the image with the specified ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$image_id = 'image_id_example'; // string | UUID of the image you want to delete.

try {
    $apiInstance->deleteImage($zone, $image_id);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->deleteImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **image_id** | **string**| UUID of the image you want to delete. | |

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

## `getImage()`

```php
getImage($zone, $image_id): \OpenAPI\Client\Model\ScalewayInstanceV1GetImageResponse
```

Get an Instance image

Get details of an image with the specified ID.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$image_id = 'image_id_example'; // string | UUID of the image you want to get.

try {
    $result = $apiInstance->getImage($zone, $image_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->getImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **image_id** | **string**| UUID of the image you want to get. | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1GetImageResponse**](../Model/ScalewayInstanceV1GetImageResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listImages()`

```php
listImages($zone, $organization, $per_page, $page, $name, $public, $arch, $project, $tags): \OpenAPI\Client\Model\ScalewayInstanceV1ListImagesResponse
```

List Instance images

List all existing Instance images.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$organization = 'organization_example'; // string
$per_page = 56; // int
$page = 1; // int | Page number
$name = 'name_example'; // string
$public = True; // bool
$arch = 'arch_example'; // string
$project = 'project_example'; // string
$tags = 'tags_example'; // string

try {
    $result = $apiInstance->listImages($zone, $organization, $per_page, $page, $name, $public, $arch, $project, $tags);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->listImages: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **organization** | **string**|  | [optional] |
| **per_page** | **int**|  | [optional] |
| **page** | **int**| Page number | [optional] [default to 1] |
| **name** | **string**|  | [optional] |
| **public** | **bool**|  | [optional] |
| **arch** | **string**|  | [optional] |
| **project** | **string**|  | [optional] |
| **tags** | **string**|  | [optional] |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1ListImagesResponse**](../Model/ScalewayInstanceV1ListImagesResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `setImage()`

```php
setImage($zone, $id, $set_image_request): \OpenAPI\Client\Model\ScalewayInstanceV1SetImageResponse
```

Update image

Replace all image properties with an image message.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$id = 'id_example'; // string
$set_image_request = new \OpenAPI\Client\Model\SetImageRequest(); // \OpenAPI\Client\Model\SetImageRequest

try {
    $result = $apiInstance->setImage($zone, $id, $set_image_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->setImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **id** | **string**|  | |
| **set_image_request** | [**\OpenAPI\Client\Model\SetImageRequest**](../Model/SetImageRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1SetImageResponse**](../Model/ScalewayInstanceV1SetImageResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateImage()`

```php
updateImage($zone, $image_id, $update_image_request): \OpenAPI\Client\Model\ScalewayInstanceV1UpdateImageResponse
```

Update image

Update the properties of an image.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\ImagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$image_id = 6170692e-7363-616c-6577-61792e636f6d; // string | UUID of the image. (UUID format)
$update_image_request = new \OpenAPI\Client\Model\UpdateImageRequest(); // \OpenAPI\Client\Model\UpdateImageRequest

try {
    $result = $apiInstance->updateImage($zone, $image_id, $update_image_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ImagesApi->updateImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **zone** | **string**| The zone you want to target | |
| **image_id** | **string**| UUID of the image. (UUID format) | |
| **update_image_request** | [**\OpenAPI\Client\Model\UpdateImageRequest**](../Model/UpdateImageRequest.md)|  | |

### Return type

[**\OpenAPI\Client\Model\ScalewayInstanceV1UpdateImageResponse**](../Model/ScalewayInstanceV1UpdateImageResponse.md)

### Authorization

[scaleway](../../README.md#scaleway)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
