# # ScalewayInstanceV1SetSecurityGroupRulesRequestRule

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | UUID of the security rule to update. If no value is provided, a new rule will be created. | [optional]
**action** | **string** | Action to apply when the rule matches a packet. | [optional] [default to 'unknown_action']
**protocol** | **string** | Protocol family this rule applies to. | [optional] [default to 'unknown_protocol']
**direction** | **string** | Direction the rule applies to. | [optional] [default to 'unknown_direction']
**ip_range** | **string** | Range of IP addresses these rules apply to. (IP network) | [optional]
**dest_port_from** | **int** | Beginning of the range of ports this rule applies to (inclusive). This value will be set to null if protocol is ICMP or ANY. | [optional]
**dest_port_to** | **int** | End of the range of ports this rule applies to (inclusive). This value will be set to null if protocol is ICMP or ANY, or if it is equal to dest_port_from. | [optional]
**position** | **int** | Position of this rule in the security group rules list. If several rules are passed with the same position, the resulting order is undefined. | [optional]
**editable** | **bool** | Indicates if this rule is editable. Rules with the value false will be ignored. | [optional]
**zone** | **string** | Zone of the rule. This field is ignored. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
