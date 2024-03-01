# # CreateSecurityGroupRuleRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**protocol** | [**\OpenAPI\Client\Model\ScalewayInstanceV1SecurityGroupRuleProtocol**](ScalewayInstanceV1SecurityGroupRuleProtocol.md) |  |
**direction** | [**\OpenAPI\Client\Model\ScalewayInstanceV1SecurityGroupRuleDirection**](ScalewayInstanceV1SecurityGroupRuleDirection.md) |  |
**action** | [**\OpenAPI\Client\Model\ScalewayInstanceV1SecurityGroupRuleAction**](ScalewayInstanceV1SecurityGroupRuleAction.md) |  |
**ip_range** | **string** | (IP network) |
**dest_port_from** | **int** | Beginning of the range of ports to apply this rule to (inclusive). | [optional]
**dest_port_to** | **int** | End of the range of ports to apply this rule to (inclusive). | [optional]
**position** | **int** | Position of this rule in the security group rules list. | [optional]
**editable** | **bool** | Indicates if this rule is editable (will be ignored). | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
