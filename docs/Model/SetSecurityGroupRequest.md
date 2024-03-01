# # SetSecurityGroupRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | Name of the security group. | [optional]
**tags** | **string[]** | Tags of the security group. | [optional]
**creation_date** | **\DateTime** | Creation date of the security group (will be ignored). (RFC 3339 format) | [optional]
**modification_date** | **\DateTime** | Modification date of the security group (will be ignored). (RFC 3339 format) | [optional]
**description** | **string** | Description of the security group. | [optional]
**enable_default_security** | **bool** | True to block SMTP on IPv4 and IPv6. This feature is read only, please open a support ticket if you need to make it configurable. | [optional]
**inbound_default_policy** | **string** | Default inbound policy. | [optional] [default to 'unknown_policy']
**outbound_default_policy** | **string** | Default outbound policy. | [optional] [default to 'unknown_policy']
**organization** | **string** | Security groups Organization ID. | [optional]
**project** | **string** | Security group Project ID. | [optional]
**organization_default** | **bool** | Please use project_default instead. | [optional]
**project_default** | **bool** | True use this security group for future Instances created in this project. | [optional]
**servers** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ServerSummary[]**](ScalewayInstanceV1ServerSummary.md) | Instances attached to this security group. | [optional]
**stateful** | **bool** | True to set the security group as stateful. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
