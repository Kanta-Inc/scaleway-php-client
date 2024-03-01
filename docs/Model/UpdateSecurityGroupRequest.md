# # UpdateSecurityGroupRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | Name of the security group. | [optional]
**description** | **string** | Description of the security group. | [optional]
**enable_default_security** | **bool** | True to block SMTP on IPv4 and IPv6. This feature is read only, please open a support ticket if you need to make it configurable. | [optional]
**inbound_default_policy** | **string** | Default inbound policy. | [optional] [default to 'unknown_policy']
**tags** | **string[]** | Tags of the security group. | [optional]
**organization_default** | **bool** | Please use project_default instead. | [optional]
**project_default** | **bool** | True use this security group for future Instances created in this project. | [optional]
**outbound_default_policy** | **string** | Default outbound policy. | [optional] [default to 'unknown_policy']
**stateful** | **bool** | True to set the security group as stateful. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
