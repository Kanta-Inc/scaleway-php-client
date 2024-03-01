# # ScalewayInstanceV1VolumeServerTemplate

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | UUID of the volume. | [optional]
**boot** | **bool** | Force the Instance to boot on this volume. | [optional] [default to false]
**name** | **string** | Name of the volume. | [optional]
**size** | **int** | Disk size of the volume, must be a multiple of 512. (in bytes) | [optional]
**volume_type** | **string** | Type of the volume. | [optional] [default to 'l_ssd']
**base_snapshot** | **string** | ID of the snapshot on which this volume will be based. | [optional]
**organization** | **string** | Organization ID of the volume. | [optional]
**project** | **string** | Project ID of the volume. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
