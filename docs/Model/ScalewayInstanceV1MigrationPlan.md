# # ScalewayInstanceV1MigrationPlan

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**volume** | [**\OpenAPI\Client\Model\ScalewayInstanceV1MigrationPlanVolume**](ScalewayInstanceV1MigrationPlanVolume.md) |  | [optional]
**snapshots** | [**\OpenAPI\Client\Model\ScalewayInstanceV1Snapshot[]**](ScalewayInstanceV1Snapshot.md) | A list of snapshots which will be migrated to SBS together and with the volume, if present. | [optional]
**validation_key** | **string** | A value to be passed to ApplyBlockMigrationRequest, to confirm that the execution of the plan is being requested. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
