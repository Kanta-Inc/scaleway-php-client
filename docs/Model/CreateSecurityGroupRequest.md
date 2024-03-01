# # CreateSecurityGroupRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | Name of the security group. |
**description** | **string** | Description of the security group. | [optional]
**organization** | **string** | Organization ID the security group belongs to. | [optional]
**project** | **string** | Project ID the security group belong to. | [optional]
**tags** | **string[]** | Tags of the security group. | [optional]
**organization_default** | **bool** | Defines whether this security group becomes the default security group for new Instances. | [optional] [default to false]
**project_default** | **bool** | Whether this security group becomes the default security group for new Instances. | [optional] [default to false]
**stateful** | **bool** | Whether the security group is stateful or not. | [optional] [default to false]
**inbound_default_policy** | **string** | Default policy for inbound rules. | [optional] [default to 'accept']
**outbound_default_policy** | **string** | Default policy for outbound rules. | [optional] [default to 'accept']
**enable_default_security** | **bool** | True to block SMTP on IPv4 and IPv6. This feature is read only, please open a support ticket if you need to make it configurable. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
