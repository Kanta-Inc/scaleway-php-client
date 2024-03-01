# # CreateServerRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | Instance name. |
**dynamic_ip_required** | **bool** | Define if a dynamic IPv4 is required for the Instance. | [optional]
**routed_ip_enabled** | **bool** | If true, configure the Instance so it uses the new routed IP mode. | [optional]
**commercial_type** | **string** | Define the Instance commercial type (i.e. GP1-S). |
**image** | **string** | Instance image ID. | [optional]
**volumes** | [**\OpenAPI\Client\Model\CreateServerRequestVolumes**](CreateServerRequestVolumes.md) |  | [optional]
**enable_ipv6** | **bool** | True if IPv6 is enabled on the server. | [optional]
**public_ip** | **string** | ID of the reserved IP to attach to the Instance. | [optional]
**public_ips** | **string[]** | A list of reserved IP IDs to attach to the Instance. | [optional]
**boot_type** | **string** | Boot type to use. | [optional] [default to 'local']
**bootscript** | **string** | Bootscript ID to use when &#x60;boot_type&#x60; is set to &#x60;bootscript&#x60;. | [optional]
**organization** | **string** | Instance Organization ID. | [optional]
**project** | **string** | Instance Project ID. | [optional]
**tags** | **string[]** | Instance tags. | [optional]
**security_group** | **string** | Security group ID. | [optional]
**placement_group** | **string** | Placement group ID if Instance must be part of a placement group. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
