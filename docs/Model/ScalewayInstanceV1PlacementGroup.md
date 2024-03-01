# # ScalewayInstanceV1PlacementGroup

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | Placement group unique ID. | [optional]
**name** | **string** | Placement group name. | [optional]
**organization** | **string** | Placement group Organization ID. | [optional]
**project** | **string** | Placement group Project ID. | [optional]
**tags** | **string[]** | Placement group tags. | [optional]
**policy_mode** | **string** | Select the failure mode when the placement cannot be respected, either optional or enforced. | [optional] [default to 'optional']
**policy_type** | **string** | Select the behavior of the placement group, either low_latency (group) or max_availability (spread). | [optional] [default to 'max_availability']
**policy_respected** | **bool** | Returns true if the policy is respected, false otherwise. | [optional]
**zone** | **string** | Zone in which the placement group is located. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
