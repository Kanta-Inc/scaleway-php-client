# # ScalewayInstanceV1SecurityGroup

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | Security group unique ID. | [optional]
**name** | **string** | Security group name. | [optional]
**description** | **string** | Security group description. | [optional]
**enable_default_security** | **bool** | True if SMTP is blocked on IPv4 and IPv6. This feature is read only, please open a support ticket if you need to make it configurable. | [optional]
**inbound_default_policy** | **string** | Default inbound policy. | [optional] [default to 'unknown_policy']
**outbound_default_policy** | **string** | Default outbound policy. | [optional] [default to 'unknown_policy']
**organization** | **string** | Security group Organization ID. | [optional]
**project** | **string** | Security group Project ID. | [optional]
**tags** | **string[]** | Security group tags. | [optional]
**organization_default** | **bool** | True if it is your default security group for this Organization ID. | [optional]
**project_default** | **bool** | True if it is your default security group for this Project ID. | [optional]
**creation_date** | **\DateTime** | Security group creation date. (RFC 3339 format) | [optional]
**modification_date** | **\DateTime** | Security group modification date. (RFC 3339 format) | [optional]
**servers** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ServerSummary[]**](ScalewayInstanceV1ServerSummary.md) | List of Instances attached to this security group. | [optional]
**stateful** | **bool** | Defines whether the security group is stateful. | [optional]
**state** | **string** | Security group state. | [optional] [default to 'available']
**zone** | **string** | Zone in which the security group is located. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
