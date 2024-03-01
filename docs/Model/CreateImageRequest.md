# # CreateImageRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | Name of the image. | [optional]
**root_volume** | **string** | UUID of the snapshot. |
**arch** | **string** | Architecture of the image. | [default to 'unknown_arch']
**default_bootscript** | **string** | Default bootscript of the image. | [optional]
**extra_volumes** | [**\OpenAPI\Client\Model\CreateImageRequestExtraVolumes**](CreateImageRequestExtraVolumes.md) |  | [optional]
**organization** | **string** | Organization ID of the image. | [optional]
**project** | **string** | Project ID of the image. | [optional]
**tags** | **string[]** | Tags of the image. | [optional]
**public** | **bool** | True to create a public image. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
