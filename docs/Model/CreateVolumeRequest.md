# # CreateVolumeRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | Volume name. | [optional]
**organization** | **string** | Volume Organization ID. | [optional]
**project** | **string** | Volume Project ID. | [optional]
**tags** | **string[]** | Volume tags. | [optional]
**volume_type** | **string** | Volume type. | [optional] [default to 'l_ssd']
**size** | **int** | Volume disk size, must be a multiple of 512. (in bytes) | [optional]
**base_snapshot** | **string** | ID of the snapshot on which this volume will be based. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
