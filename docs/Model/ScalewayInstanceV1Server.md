# # ScalewayInstanceV1Server

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | Instance unique ID. | [optional]
**name** | **string** | Instance name. | [optional]
**organization** | **string** | Instance Organization ID. | [optional]
**project** | **string** | Instance Project ID. | [optional]
**allowed_actions** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ServerAction[]**](ScalewayInstanceV1ServerAction.md) | List of allowed actions on the Instance. | [optional]
**tags** | **string[]** | Tags associated with the Instance. | [optional]
**commercial_type** | **string** | Instance commercial type (eg. GP1-M). | [optional]
**creation_date** | **\DateTime** | Instance creation date. (RFC 3339 format) | [optional]
**dynamic_ip_required** | **bool** | True if a dynamic IPv4 is required. | [optional]
**routed_ip_enabled** | **bool** | True to configure the instance so it uses the new routed IP mode. | [optional]
**enable_ipv6** | **bool** | True if IPv6 is enabled. | [optional]
**hostname** | **string** | Instance host name. | [optional]
**image** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ServerImage**](ScalewayInstanceV1ServerImage.md) |  | [optional]
**protected** | **bool** | Defines whether the Instance protection option is activated. | [optional]
**private_ip** | **string** | Private IP address of the Instance. | [optional]
**public_ip** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ServerPublicIp**](ScalewayInstanceV1ServerPublicIp.md) |  | [optional]
**public_ips** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ServerIp[]**](ScalewayInstanceV1ServerIp.md) | Information about all the public IPs attached to the server. | [optional]
**mac_address** | **string** | The server&#39;s MAC address. | [optional]
**modification_date** | **\DateTime** | Instance modification date. (RFC 3339 format) | [optional]
**state** | **string** | Instance state. | [optional] [default to 'running']
**location** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ServerLocation**](ScalewayInstanceV1ServerLocation.md) |  | [optional]
**ipv6** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ServerIpv6**](ScalewayInstanceV1ServerIpv6.md) |  | [optional]
**bootscript** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ServerBootscript**](ScalewayInstanceV1ServerBootscript.md) |  | [optional]
**boot_type** | **string** | Instance boot type. | [optional] [default to 'local']
**volumes** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ServerVolumes**](ScalewayInstanceV1ServerVolumes.md) |  | [optional]
**security_group** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ServerSecurityGroup**](ScalewayInstanceV1ServerSecurityGroup.md) |  | [optional]
**maintenances** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ServerMaintenance[]**](ScalewayInstanceV1ServerMaintenance.md) | Instance planned maintenance. | [optional]
**state_detail** | **string** | Detailed information about the Instance state. | [optional]
**arch** | **string** | Instance architecture. | [optional] [default to 'unknown_arch']
**placement_group** | [**\OpenAPI\Client\Model\ScalewayInstanceV1ServerPlacementGroup**](ScalewayInstanceV1ServerPlacementGroup.md) |  | [optional]
**private_nics** | [**\OpenAPI\Client\Model\ScalewayInstanceV1PrivateNIC[]**](ScalewayInstanceV1PrivateNIC.md) | Instance private NICs. | [optional]
**zone** | **string** | Zone in which the Instance is located. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
