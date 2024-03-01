# # CreateIpRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**organization** | **string** | Organization ID in which the IP is reserved. | [optional]
**project** | **string** | Project ID in which the IP is reserved. | [optional]
**tags** | **string[]** | Tags of the IP. | [optional]
**server** | **string** | UUID of the Instance you want to attach the IP to. | [optional]
**type** | **string** | IP type to reserve (either &#39;nat&#39;, &#39;routed_ipv4&#39; or &#39;routed_ipv6&#39;). | [optional] [default to 'unknown_iptype']

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
