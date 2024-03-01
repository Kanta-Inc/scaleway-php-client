# # ScalewayInstanceV1ServerPublicIp

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | Unique ID of the IP address. | [optional]
**address** | **string** | Instance&#39;s public IP-Address. (IP address) | [optional]
**gateway** | **string** | Gateway&#39;s IP address. (IP address) | [optional]
**netmask** | **string** | CIDR netmask. | [optional]
**family** | **string** | IP address family (inet or inet6). | [optional] [default to 'inet']
**dynamic** | **bool** | True if the IP address is dynamic. | [optional]
**provisioning_mode** | **string** | Information about this address provisioning mode. | [optional] [default to 'manual']
**tags** | **string[]** | Tags associated with the IP. | [optional]
**ipam_id** | **string** | The ip_id of an IPAM ip if the ip is created from IPAM, null if not. (UUID format) | [optional]
**state** | **string** | IP address state. | [optional] [default to 'unknown_state']

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
