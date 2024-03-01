# # ScalewayInstanceV1ServerImage

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** |  | [optional]
**name** | **string** |  | [optional]
**arch** | [**\OpenAPI\Client\Model\ScalewayInstanceV1Arch**](ScalewayInstanceV1Arch.md) |  | [optional]
**creation_date** | **\DateTime** | (RFC 3339 format) | [optional]
**modification_date** | **\DateTime** | (RFC 3339 format) | [optional]
**default_bootscript** | [**\OpenAPI\Client\Model\ScalewayInstanceV1Bootscript**](ScalewayInstanceV1Bootscript.md) |  | [optional]
**extra_volumes** | [**\OpenAPI\Client\Model\SetImageRequestExtraVolumes**](SetImageRequestExtraVolumes.md) |  | [optional]
**from_server** | **string** |  | [optional]
**organization** | **string** |  | [optional]
**public** | **bool** |  | [optional]
**root_volume** | [**\OpenAPI\Client\Model\ScalewayInstanceV1VolumeSummary**](ScalewayInstanceV1VolumeSummary.md) |  | [optional]
**state** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ImageState**](ScalewayInstanceV1ImageState.md) |  | [optional]
**project** | **string** |  | [optional]
**tags** | **string[]** |  | [optional]
**zone** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
