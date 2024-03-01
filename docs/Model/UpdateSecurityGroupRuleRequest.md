# # UpdateSecurityGroupRuleRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**protocol** | **string** | Protocol family this rule applies to. | [optional] [default to 'unknown_protocol']
**direction** | **string** | Direction the rule applies to. | [optional] [default to 'unknown_direction']
**action** | **string** | Action to apply when the rule matches a packet. | [optional] [default to 'unknown_action']
**ip_range** | **string** | Range of IP addresses these rules apply to. (IP network) | [optional]
**dest_port_from** | **int** | Beginning of the range of ports this rule applies to (inclusive). If 0 is provided, unset the parameter. | [optional]
**dest_port_to** | **int** | End of the range of ports this rule applies to (inclusive). If 0 is provided, unset the parameter. | [optional]
**position** | **int** | Position of this rule in the security group rules list. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
