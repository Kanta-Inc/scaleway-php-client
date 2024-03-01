# # UpdateServerRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | Name of the Instance. | [optional]
**boot_type** | [**\OpenAPI\Client\Model\ScalewayInstanceV1BootType**](ScalewayInstanceV1BootType.md) |  | [optional]
**tags** | **string[]** | Tags of the Instance. | [optional]
**volumes** | [**\OpenAPI\Client\Model\UpdateServerRequestVolumes**](UpdateServerRequestVolumes.md) |  | [optional]
**bootscript** | **string** |  | [optional]
**dynamic_ip_required** | **bool** |  | [optional]
**routed_ip_enabled** | **bool** | True to configure the instance so it uses the new routed IP mode (once this is set to True you cannot set it back to False). | [optional]
**public_ips** | **string[]** | A list of reserved IP IDs to attach to the Instance. | [optional]
**enable_ipv6** | **bool** |  | [optional]
**protected** | **bool** |  | [optional]
**security_group** | [**\OpenAPI\Client\Model\ScalewayInstanceV1SecurityGroupTemplate**](ScalewayInstanceV1SecurityGroupTemplate.md) |  | [optional]
**placement_group** | **string** | Placement group ID if Instance must be part of a placement group. | [optional]
**private_nics** | **string[]** | Instance private NICs. | [optional]
**commercial_type** | **string** | Set the commercial_type for this Instance. Warning: This field has some restrictions: - Cannot be changed if the Instance is not in &#x60;stopped&#x60; state. - Cannot be changed if the Instance is in a placement group. - Local storage requirements of the target commercial_types must be fulfilled (i.e. if an Instance has 80GB of local storage, it can be changed into a GP1-XS, which has a maximum of 150GB, but it cannot be changed into a DEV1-S, which has only 20GB). | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
