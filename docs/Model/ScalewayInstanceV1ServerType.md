# # ScalewayInstanceV1ServerType

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**monthly_price** | **float** | Estimated monthly price, for a 30 days month, in Euro. | [optional]
**hourly_price** | **float** | Hourly price in Euro. | [optional]
**alt_names** | **string[]** | Alternative Instance name, if any. | [optional]
**per_volume_constraint** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ServerTypePerVolumeConstraint**](ScalewayInstanceV1ServerTypePerVolumeConstraint.md) |  | [optional]
**volumes_constraint** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ServerTypeVolumesConstraint**](ScalewayInstanceV1ServerTypeVolumesConstraint.md) |  | [optional]
**ncpus** | **int** | Number of CPU. | [optional]
**gpu** | **int** | Number of GPU. | [optional]
**ram** | **int** | Available RAM in bytes. | [optional]
**arch** | **string** | CPU architecture. | [optional] [default to 'unknown_arch']
**baremetal** | **bool** | True if it is a baremetal Instance. | [optional]
**network** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ServerTypeNetwork**](ScalewayInstanceV1ServerTypeNetwork.md) |  | [optional]
**capabilities** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ServerTypeCapabilities**](ScalewayInstanceV1ServerTypeCapabilities.md) |  | [optional]
**scratch_storage_max_size** | **int** | Maximum available scratch storage. (in bytes) | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
