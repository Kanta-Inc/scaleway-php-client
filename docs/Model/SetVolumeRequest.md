# # SetVolumeRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | Name of the volume. | [optional]
**tags** | **string[]** | Tags of the volume. | [optional]
**export_uri** | **string** | Show the volumes NBD export URI, this field is ignored. | [optional]
**size** | **int** | Volume&#39;s disk size, must be a multiple of 512. (in bytes) | [optional]
**volume_type** | **string** | Volume type. | [optional] [default to 'l_ssd']
**creation_date** | **\DateTime** | Volume creation date. (RFC 3339 format) | [optional]
**modification_date** | **\DateTime** | Volume modification date. (RFC 3339 format) | [optional]
**organization** | **string** | Volume Organization ID. | [optional]
**project** | **string** | Volume Project ID. | [optional]
**server** | [**\OpenAPI\Client\Model\SetVolumeRequestServer**](SetVolumeRequestServer.md) |  | [optional]
**state** | **string** | Volume state. | [optional] [default to 'available']

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
