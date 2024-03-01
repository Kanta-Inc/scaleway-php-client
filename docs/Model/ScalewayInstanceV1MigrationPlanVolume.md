# # ScalewayInstanceV1MigrationPlanVolume

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | Volume unique ID. | [optional]
**name** | **string** | Volume name. | [optional]
**export_uri** | **string** | Show the volume NBD export URI. | [optional]
**size** | **int** | Volume disk size. (in bytes) | [optional]
**volume_type** | **string** | Volume type. | [optional] [default to 'l_ssd']
**creation_date** | **\DateTime** | Volume creation date. (RFC 3339 format) | [optional]
**modification_date** | **\DateTime** | Volume modification date. (RFC 3339 format) | [optional]
**organization** | **string** | Volume Organization ID. | [optional]
**project** | **string** | Volume Project ID. | [optional]
**tags** | **string[]** | Volume tags. | [optional]
**server** | [**\OpenAPI\Client\Model\SetVolumeRequestServer**](SetVolumeRequestServer.md) |  | [optional]
**state** | **string** | Volume state. | [optional] [default to 'available']
**zone** | **string** | Zone in which the volume is located. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
