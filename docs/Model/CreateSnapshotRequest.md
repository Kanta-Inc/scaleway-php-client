# # CreateSnapshotRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | Name of the snapshot. | [optional]
**volume_id** | **string** | UUID of the volume. | [optional]
**tags** | **string[]** | Tags of the snapshot. | [optional]
**organization** | **string** | Organization ID of the snapshot. | [optional]
**project** | **string** | Project ID of the snapshot. | [optional]
**volume_type** | **string** | Volume type of the snapshot. Overrides the volume_type of the snapshot. If omitted, the volume type of the original volume will be used. | [optional] [default to 'unknown_volume_type']
**bucket** | **string** | Bucket name for snapshot imports. | [optional]
**key** | **string** | Object key for snapshot imports. | [optional]
**size** | **int** | Imported snapshot size, must be a multiple of 512. (in bytes) | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
