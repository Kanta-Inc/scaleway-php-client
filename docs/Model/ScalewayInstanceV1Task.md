# # ScalewayInstanceV1Task

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | Unique ID of the task. | [optional]
**description** | **string** | Description of the task. | [optional]
**progress** | **int** | Progress of the task in percent. | [optional]
**started_at** | **\DateTime** | Task start date. (RFC 3339 format) | [optional]
**terminated_at** | **\DateTime** | Task end date. (RFC 3339 format) | [optional]
**status** | **string** | Task status. | [optional] [default to 'pending']
**href_from** | **string** |  | [optional]
**href_result** | **string** |  | [optional]
**zone** | **string** | Zone in which the task is excecuted. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
