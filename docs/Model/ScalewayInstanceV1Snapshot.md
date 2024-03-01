# # ScalewayInstanceV1Snapshot

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | Snapshot ID. | [optional]
**name** | **string** | Snapshot name. | [optional]
**organization** | **string** | Snapshot Organization ID. | [optional]
**project** | **string** | Snapshot Project ID. | [optional]
**tags** | **string[]** | Snapshot tags. | [optional]
**volume_type** | **string** | Snapshot volume type. | [optional] [default to 'l_ssd']
**size** | **int** | Snapshot size. (in bytes) | [optional]
**state** | **string** | Snapshot state. | [optional] [default to 'available']
**base_volume** | [**\OpenAPI\Client\Model\ScalewayInstanceV1SnapshotBaseVolume**](ScalewayInstanceV1SnapshotBaseVolume.md) |  | [optional]
**creation_date** | **\DateTime** | Snapshot creation date. (RFC 3339 format) | [optional]
**modification_date** | **\DateTime** | Snapshot modification date. (RFC 3339 format) | [optional]
**zone** | **string** | Snapshot zone. | [optional]
**error_reason** | **string** | Reason for the failed snapshot import. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
