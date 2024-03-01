# # ApplyBlockMigrationRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**volume_id** | **string** | The volume to migrate, along with potentially other resources, according to the migration plan generated with a call to PlanBlockMigration. | [optional]
**snapshot_id** | **string** | The snapshot to migrate, along with potentially other resources, according to the migration plan generated with a call to PlanBlockMigration. | [optional]
**validation_key** | **string** | A value to be retrieved from a call to PlanBlockMigration, to confirm that the volume and/or snapshots specified in said plan should be migrated. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
