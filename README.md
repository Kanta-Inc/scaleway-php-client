# OpenAPIClient-php

Scaleway Instances are virtual machines in the cloud. Different [Instance types](https://www.scaleway.com/en/docs/compute/instances/reference-content/choosing-instance-type/) offer different technical specifications in terms of vCPU, RAM, bandwidth and storage. Once you have created your Instance and installed your image of choice (e.g. an operating system), you can [connect to your Instance via SSH](https://www.scaleway.com/en/docs/compute/instances/how-to/connect-to-instance/) to use it as you wish. When you are done using the Instance, you can delete it from your account.

(switchcolumn)
<Message type=\"tip\">
To retrieve information about the different [images](#path-images) available to install on Scaleway Instances, check out our [Marketplace API](https://www.scaleway.com/en/developers/api/marketplace).
</Message>
(switchcolumn)


## Concepts

Refer to our [dedicated concepts page](https://www.scaleway.com/en/docs/compute/instances/concepts/) to find definitions of all concepts and terminology related to Instances.

(switchcolumn)
(switchcolumn)

## Quickstart

1. Configure your environment variables

    <Message type=\"note\"> 
    This is an optional step that seeks to simplify your usage of the Instances API. See [Availability Zones](#availability-zones) below for help choosing an Availability Zone. You can find your Project ID in the [Scaleway console](https://console.scaleway.com/project/settings).
    </Message>

    ```bash
    export SCW_SECRET_KEY=\"<API secret key>\"
    export SCW_DEFAULT_ZONE=\"<Scaleway Availability Zone>\"
    export SCW_PROJECT_ID=\"<Scaleway Project ID>\"
    ```

2. **Create an Instance**: Run the following command to create an Instance. You can customize the details in the payload (name, description, type, tags etc) to your needs: use the information below to adjust the payload as necessary.

    ```bash
    curl -X POST \\
      -H \"X-Auth-Token: $SCW_SECRET_KEY\" \\
      -H \"Content-Type: application/json\" \\
      \"https://api.scaleway.com/instance/v1/zones/$SCW_DEFAULT_ZONE/servers\" \\
        -d '{
          \"name\": \"my-new-instance\", 
          \"project\": \"'\"$SCW_PROJECT_ID\"'\",
          \"commercial_type\": \"GP1-S\", 
          \"image\": \"544f0add-626b-4e4f-8a96-79fa4414d99a\",
          \"enable_ipv6\": true,
          \"volumes\": {
            \"0\":{
              \"name\": \"my-volume\",
              \"size\": 300000000000,
              \"volume_type\": \"l_ssd\"
            }
          }
        }'
    ```

        | Parameter       | Description                                                                                                                                              | Valid values                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
    | --------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
    | `name`            | A name of your choice for the Instance (string)                                                                                                          | Any string containing only alphanumeric characters, dots, spaces and dashes, e.g. `\"my-new-instance\"`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          |
    | `project`         | The Project in which the Instance should be created (string)                                                                                             | Any valid Scaleway Project ID (see above), e.g. `\"b4bd99e0-b389-11ed-afa1-0242ac120002\"`                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
    | `commercial-type` | The commercial Instance type to create (string)                                                                                                          | Any valid ID of a Scaleway commercial Instance type, e.g. `\"GP1-S\"`, `\"PRO2-M\"`. Use the [List Instance Types](#path-instance-types-list-instance-types) endpoint to get a list of all valid Instance types and their IDs.                                                                                                                                                                                                                                                                               |
    | `image`           | The image to install on the Instance, e.g. a particular OS (string)                                                                                      | Any valid Scaleway image ID, e.g. `\"544f0add-626b-4e4f-8a96-79fa4414d99a\"` which is the ID for the `Ubuntu 22.04 Jammy Jellyfish` image. Use the [List Instance Images](#path-images-list-instance-images) endpoint to get a list of all available images and their IDs, or check out the [Scaleway Marketplace API](https://www.scaleway.com/en/developers/api/marketplace).                                                                                                                                                                                                                                                                                                     |
    | `enable_ipv6`     | Whether to enable IPv6 on the Instance (boolean)                                                                                                         | `true` or `false`                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
    | `volumes`         | An object that specifies the storage volumes to attach to the Instance. For more information, see **Creating an Instance: the volumes object** in the [Technical information](#technical-information) section of this quickstart. | A (dictionary) object with a minimum of one key (`\"0\"`) whose value is another object containing the parameters `\"name\"` (a name for the volume), `\"size\"` (the size for the volume, in bytes), and `\"volume_type\"` (`\"l_ssd\"`, `\"b_ssd\"` or `\"unified\"`). Additional keys for additional volumes should increment by 1 each time (the second volume would have a key of `1`.) Further parameters are available, and it is possible to attach existing volumes rather than creating a new one, or create a volume from a snapshot. |

3. **List your Instances**: run the following command to get a list of all the Instances in your account, with their details:

    ```bash
    curl -X GET \\
      -H \"Content-Type: application/json\" \\
      -H \"X-Auth-Token: $SCW_SECRET_KEY\" \\
      \"https://api.scaleway.com/instance/v1/zones/$SCW_DEFAULT_ZONE/servers/\"
    ```

4. **Delete an Instance**: run the following command to delete an Instance, specified by its Instance ID:

    ```bash
    curl -X DELETE \\
      -H \"X-Auth-Token: $SCW_SECRET_KEY\" \\
      -H \"Content-Type: application/json\" \\
      \"https://api.scaleway.com/instance/v1/zones/$SCW_DEFAULT_ZONE/servers/<Instance-ID>\"
    ```

    The expected successful response is empty.

(switchcolumn)
<Message type=\"requirement\">
- You have a [Scaleway account](https://console.scaleway.com/)
- You have created an [API key](https://www.scaleway.com/en/docs/identity-and-access-management/iam/how-to/create-api-keys/) and that the API key has sufficient [IAM permissions](https://www.scaleway.com/en/docs/identity-and-access-management/iam/reference-content/permission-sets/) to perform the actions described on this page
- You have [installed `curl`](https://curl.se/download.html)
</Message>
(switchcolumn)

## Technical information

### Availability Zones

Instances can be deployed in the following Availability Zones:

| Name      | API ID                |
|-----------|-----------------------|
| Paris     | `fr-par-1` `fr-par-2` `fr-par-3` |
| Amsterdam | `nl-ams-1` `nl-ams-2` |
| Warsaw    | `pl-waw-1` `pl-waw-2` |

(switchcolumn)
(switchcolumn)

### Pagination

Most listing requests receive a paginated response. Requests against paginated endpoints accept two `query` arguments:

- `page`, a positive integer to choose which page to return.
- `per_page`, an positive integer lower or equal to 100 to select the number of items to return per page. The default value is `50`.

Paginated endpoints usually also accept filters to search and sort results.These filters are documented along each endpoint documentation.

The `X-Total-Count` header contains the total number of items returned.

(switchcolumn)
(switchcolumn)

### Creating an Instance: the volumes object

When [creating an Instance](#path-instances-create-an-instance), the `volumes` object is a required part of the payload. This is a dictionary with a minimum of one key (`\"0\"`) whose value is another object setting parameters for that volume. Additional keys for additional volumes should increment by 1 each time (the second volume would have a key of `1`.)

Note that volume `size` must respect the volume constraints of the Instance's `commercial_type`: for each type of Instance, a minimum amount of storage is required, and there is also a maximum that cannot be exceeded. Some Instance types support only Block Storage (`b_ssd`), others also support local storage (`l_ssd`) ). Read more about these constraints in the [List Instance types](#path-instance-types-list-instance-types) documentation, specifically the `volume_constraints` parameter for each type listed in the response

You can use the `volumes` object in different ways. The table below shows which parameters are required for each of the following use cases:

| Use case                | Required params       | Optional params     | Notes                                  |
|-------------------------|-----------------------|---------------------|----------------------------------------|
| Create a volume from a snapshot of an image  |  | `volume_type`, `size`, `boot` | If the `size` parameter is not set, the size of the volume will equal the size of the corresponding snapshot of the image. |
| Attach an existing volume   | `id`, `name` | `boot` |  |
| Create an empty volume      | `name`, `volume_type`, `size` | `organization`, `project`, `boot` |  |
| Create a volume from a snapshot     | `base_snapshot`, `name`, `volume_type` | `organization`, `project`, `boot` |  |

(switchcolumn)
<Message type=\"note\">
This information is designed to help you correctly configure the `volumes` object when using the [Create an Instance](#path-instances-create-an-instance) or [Update an Instance](#path-instances-update-an-instance) methods. 
</Message>
(switchcolumn)

## Going further

For more help using Scaleway Instances, check out the following resources:
- Our [main documentation](https://www.scaleway.com/en/docs/compute/instances/)
- The #instance channel on our [Slack Community](https://www.scaleway.com/en/docs/tutorials/scaleway-slack-community/)
- Our [support ticketing system](https://www.scaleway.com/en/docs/console/my-account/how-to/open-a-support-ticket/).


## Installation & Usage

### Requirements

PHP 7.4 and later.
Should also work with PHP 8.0.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/GIT_USER_ID/GIT_REPO_ID.git"
    }
  ],
  "require": {
    "GIT_USER_ID/GIT_REPO_ID": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



// Configure API key authorization: scaleway
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('X-Auth-Token', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-Auth-Token', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\BootscriptsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$zone = 'zone_example'; // string | The zone you want to target
$bootscript_id = 'bootscript_id_example'; // string

try {
    $result = $apiInstance->getBootscript($zone, $bootscript_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BootscriptsApi->getBootscript: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *https://api.scaleway.com*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*BootscriptsApi* | [**getBootscript**](docs/Api/BootscriptsApi.md#getbootscript) | **GET** /instance/v1/zones/{zone}/bootscripts/{bootscript_id} | Get bootscripts
*BootscriptsApi* | [**listBootscripts**](docs/Api/BootscriptsApi.md#listbootscripts) | **GET** /instance/v1/zones/{zone}/bootscripts | List bootscripts
*DefaultApi* | [**attachServerVolume**](docs/Api/DefaultApi.md#attachservervolume) | **POST** /instance/v1/zones/{zone}/servers/{server_id}/attach-volume | 
*DefaultApi* | [**detachServerVolume**](docs/Api/DefaultApi.md#detachservervolume) | **POST** /instance/v1/zones/{zone}/servers/{server_id}/detach-volume | 
*DefaultApi* | [**getDashboard**](docs/Api/DefaultApi.md#getdashboard) | **GET** /instance/v1/zones/{zone}/dashboard | 
*IPsApi* | [**createIp**](docs/Api/IPsApi.md#createip) | **POST** /instance/v1/zones/{zone}/ips | Reserve a flexible IP
*IPsApi* | [**deleteIp**](docs/Api/IPsApi.md#deleteip) | **DELETE** /instance/v1/zones/{zone}/ips/{ip} | Delete a flexible IP
*IPsApi* | [**getIp**](docs/Api/IPsApi.md#getip) | **GET** /instance/v1/zones/{zone}/ips/{ip} | Get a flexible IP
*IPsApi* | [**listIps**](docs/Api/IPsApi.md#listips) | **GET** /instance/v1/zones/{zone}/ips | List all flexible IPs
*IPsApi* | [**updateIp**](docs/Api/IPsApi.md#updateip) | **PATCH** /instance/v1/zones/{zone}/ips/{ip} | Update a flexible IP
*ImagesApi* | [**createImage**](docs/Api/ImagesApi.md#createimage) | **POST** /instance/v1/zones/{zone}/images | Create an Instance image
*ImagesApi* | [**deleteImage**](docs/Api/ImagesApi.md#deleteimage) | **DELETE** /instance/v1/zones/{zone}/images/{image_id} | Delete an Instance image
*ImagesApi* | [**getImage**](docs/Api/ImagesApi.md#getimage) | **GET** /instance/v1/zones/{zone}/images/{image_id} | Get an Instance image
*ImagesApi* | [**listImages**](docs/Api/ImagesApi.md#listimages) | **GET** /instance/v1/zones/{zone}/images | List Instance images
*ImagesApi* | [**setImage**](docs/Api/ImagesApi.md#setimage) | **PUT** /instance/v1/zones/{zone}/images/{id} | Update image
*ImagesApi* | [**updateImage**](docs/Api/ImagesApi.md#updateimage) | **PATCH** /instance/v1/zones/{zone}/images/{image_id} | Update image
*InstanceTypesApi* | [**getServerTypesAvailability**](docs/Api/InstanceTypesApi.md#getservertypesavailability) | **GET** /instance/v1/zones/{zone}/products/servers/availability | Get availability
*InstanceTypesApi* | [**listServersTypes**](docs/Api/InstanceTypesApi.md#listserverstypes) | **GET** /instance/v1/zones/{zone}/products/servers | List Instance types
*InstancesApi* | [**createServer**](docs/Api/InstancesApi.md#createserver) | **POST** /instance/v1/zones/{zone}/servers | Create an Instance
*InstancesApi* | [**deleteServer**](docs/Api/InstancesApi.md#deleteserver) | **DELETE** /instance/v1/zones/{zone}/servers/{server_id} | Delete an Instance
*InstancesApi* | [**getServer**](docs/Api/InstancesApi.md#getserver) | **GET** /instance/v1/zones/{zone}/servers/{server_id} | Get an Instance
*InstancesApi* | [**listServerActions**](docs/Api/InstancesApi.md#listserveractions) | **GET** /instance/v1/zones/{zone}/servers/{server_id}/action | List Instance actions
*InstancesApi* | [**listServers**](docs/Api/InstancesApi.md#listservers) | **GET** /instance/v1/zones/{zone}/servers | List all Instances
*InstancesApi* | [**serverAction**](docs/Api/InstancesApi.md#serveraction) | **POST** /instance/v1/zones/{zone}/servers/{server_id}/action | Perform action
*InstancesApi* | [**updateServer**](docs/Api/InstancesApi.md#updateserver) | **PATCH** /instance/v1/zones/{zone}/servers/{server_id} | Update an Instance
*PlacementGroupsApi* | [**createPlacementGroup**](docs/Api/PlacementGroupsApi.md#createplacementgroup) | **POST** /instance/v1/zones/{zone}/placement_groups | Create a placement group
*PlacementGroupsApi* | [**deletePlacementGroup**](docs/Api/PlacementGroupsApi.md#deleteplacementgroup) | **DELETE** /instance/v1/zones/{zone}/placement_groups/{placement_group_id} | Delete the specified placement group
*PlacementGroupsApi* | [**getPlacementGroup**](docs/Api/PlacementGroupsApi.md#getplacementgroup) | **GET** /instance/v1/zones/{zone}/placement_groups/{placement_group_id} | Get a placement group
*PlacementGroupsApi* | [**getPlacementGroupServers**](docs/Api/PlacementGroupsApi.md#getplacementgroupservers) | **GET** /instance/v1/zones/{zone}/placement_groups/{placement_group_id}/servers | Get placement group servers
*PlacementGroupsApi* | [**listPlacementGroups**](docs/Api/PlacementGroupsApi.md#listplacementgroups) | **GET** /instance/v1/zones/{zone}/placement_groups | List placement groups
*PlacementGroupsApi* | [**setPlacementGroup**](docs/Api/PlacementGroupsApi.md#setplacementgroup) | **PUT** /instance/v1/zones/{zone}/placement_groups/{placement_group_id} | Set placement group
*PlacementGroupsApi* | [**setPlacementGroupServers**](docs/Api/PlacementGroupsApi.md#setplacementgroupservers) | **PUT** /instance/v1/zones/{zone}/placement_groups/{placement_group_id}/servers | Set placement group servers
*PlacementGroupsApi* | [**updatePlacementGroup**](docs/Api/PlacementGroupsApi.md#updateplacementgroup) | **PATCH** /instance/v1/zones/{zone}/placement_groups/{placement_group_id} | Update a placement group
*PlacementGroupsApi* | [**updatePlacementGroupServers**](docs/Api/PlacementGroupsApi.md#updateplacementgroupservers) | **PATCH** /instance/v1/zones/{zone}/placement_groups/{placement_group_id}/servers | Update placement group servers
*PrivateNICsApi* | [**createPrivateNIC**](docs/Api/PrivateNICsApi.md#createprivatenic) | **POST** /instance/v1/zones/{zone}/servers/{server_id}/private_nics | Create a private NIC connecting an Instance to a Private Network
*PrivateNICsApi* | [**deletePrivateNIC**](docs/Api/PrivateNICsApi.md#deleteprivatenic) | **DELETE** /instance/v1/zones/{zone}/servers/{server_id}/private_nics/{private_nic_id} | Delete a private NIC
*PrivateNICsApi* | [**getPrivateNIC**](docs/Api/PrivateNICsApi.md#getprivatenic) | **GET** /instance/v1/zones/{zone}/servers/{server_id}/private_nics/{private_nic_id} | Get a private NIC
*PrivateNICsApi* | [**listPrivateNICs**](docs/Api/PrivateNICsApi.md#listprivatenics) | **GET** /instance/v1/zones/{zone}/servers/{server_id}/private_nics | List all private NICs
*PrivateNICsApi* | [**updatePrivateNIC**](docs/Api/PrivateNICsApi.md#updateprivatenic) | **PATCH** /instance/v1/zones/{zone}/servers/{server_id}/private_nics/{private_nic_id} | Update a private NIC
*SecurityGroupsApi* | [**createSecurityGroup**](docs/Api/SecurityGroupsApi.md#createsecuritygroup) | **POST** /instance/v1/zones/{zone}/security_groups | Create a security group
*SecurityGroupsApi* | [**createSecurityGroupRule**](docs/Api/SecurityGroupsApi.md#createsecuritygrouprule) | **POST** /instance/v1/zones/{zone}/security_groups/{security_group_id}/rules | Create rule
*SecurityGroupsApi* | [**deleteSecurityGroup**](docs/Api/SecurityGroupsApi.md#deletesecuritygroup) | **DELETE** /instance/v1/zones/{zone}/security_groups/{security_group_id} | Delete a security group
*SecurityGroupsApi* | [**deleteSecurityGroupRule**](docs/Api/SecurityGroupsApi.md#deletesecuritygrouprule) | **DELETE** /instance/v1/zones/{zone}/security_groups/{security_group_id}/rules/{security_group_rule_id} | Delete rule
*SecurityGroupsApi* | [**getSecurityGroup**](docs/Api/SecurityGroupsApi.md#getsecuritygroup) | **GET** /instance/v1/zones/{zone}/security_groups/{security_group_id} | Get a security group
*SecurityGroupsApi* | [**getSecurityGroupRule**](docs/Api/SecurityGroupsApi.md#getsecuritygrouprule) | **GET** /instance/v1/zones/{zone}/security_groups/{security_group_id}/rules/{security_group_rule_id} | Get rule
*SecurityGroupsApi* | [**listDefaultSecurityGroupRules**](docs/Api/SecurityGroupsApi.md#listdefaultsecuritygrouprules) | **GET** /instance/v1/zones/{zone}/security_groups/default/rules | Get default rules
*SecurityGroupsApi* | [**listSecurityGroupRules**](docs/Api/SecurityGroupsApi.md#listsecuritygrouprules) | **GET** /instance/v1/zones/{zone}/security_groups/{security_group_id}/rules | List rules
*SecurityGroupsApi* | [**listSecurityGroups**](docs/Api/SecurityGroupsApi.md#listsecuritygroups) | **GET** /instance/v1/zones/{zone}/security_groups | List security groups
*SecurityGroupsApi* | [**setSecurityGroup**](docs/Api/SecurityGroupsApi.md#setsecuritygroup) | **PUT** /instance/v1/zones/{zone}/security_groups/{id} | Update a security group
*SecurityGroupsApi* | [**setSecurityGroupRule**](docs/Api/SecurityGroupsApi.md#setsecuritygrouprule) | **PUT** /instance/v1/zones/{zone}/security_groups/{security_group_id}/rules/{security_group_rule_id} | Set security group rule
*SecurityGroupsApi* | [**setSecurityGroupRules**](docs/Api/SecurityGroupsApi.md#setsecuritygrouprules) | **PUT** /instance/v1/zones/{zone}/security_groups/{security_group_id}/rules | Update all the rules of a security group
*SecurityGroupsApi* | [**updateSecurityGroup**](docs/Api/SecurityGroupsApi.md#updatesecuritygroup) | **PATCH** /instance/v1/zones/{zone}/security_groups/{security_group_id} | Update a security group
*SecurityGroupsApi* | [**updateSecurityGroupRule**](docs/Api/SecurityGroupsApi.md#updatesecuritygrouprule) | **PATCH** /instance/v1/zones/{zone}/security_groups/{security_group_id}/rules/{security_group_rule_id} | Update security group rule
*SnapshotsApi* | [**createSnapshot**](docs/Api/SnapshotsApi.md#createsnapshot) | **POST** /instance/v1/zones/{zone}/snapshots | Create a snapshot from a specified volume or from a QCOW2 file
*SnapshotsApi* | [**deleteSnapshot**](docs/Api/SnapshotsApi.md#deletesnapshot) | **DELETE** /instance/v1/zones/{zone}/snapshots/{snapshot_id} | Delete a snapshot
*SnapshotsApi* | [**exportSnapshot**](docs/Api/SnapshotsApi.md#exportsnapshot) | **POST** /instance/v1/zones/{zone}/snapshots/{snapshot_id}/export | Export a snapshot
*SnapshotsApi* | [**getSnapshot**](docs/Api/SnapshotsApi.md#getsnapshot) | **GET** /instance/v1/zones/{zone}/snapshots/{snapshot_id} | Get a snapshot
*SnapshotsApi* | [**listSnapshots**](docs/Api/SnapshotsApi.md#listsnapshots) | **GET** /instance/v1/zones/{zone}/snapshots | List snapshots
*SnapshotsApi* | [**setSnapshot**](docs/Api/SnapshotsApi.md#setsnapshot) | **PUT** /instance/v1/zones/{zone}/snapshots/{snapshot_id} | Set snapshot
*SnapshotsApi* | [**updateSnapshot**](docs/Api/SnapshotsApi.md#updatesnapshot) | **PATCH** /instance/v1/zones/{zone}/snapshots/{snapshot_id} | Update a snapshot
*UserDataApi* | [**deleteServerUserData**](docs/Api/UserDataApi.md#deleteserveruserdata) | **DELETE** /instance/v1/zones/{zone}/servers/{server_id}/user_data/{key} | Delete user data
*UserDataApi* | [**getServerUserData**](docs/Api/UserDataApi.md#getserveruserdata) | **GET** /instance/v1/zones/{zone}/servers/{server_id}/user_data/{key} | Get user data
*UserDataApi* | [**listServerUserData**](docs/Api/UserDataApi.md#listserveruserdata) | **GET** /instance/v1/zones/{zone}/servers/{server_id}/user_data | List user data
*UserDataApi* | [**setServerUserData**](docs/Api/UserDataApi.md#setserveruserdata) | **PATCH** /instance/v1/zones/{zone}/servers/{server_id}/user_data/{key} | Add/set user data
*VolumeTypesApi* | [**listVolumesTypes**](docs/Api/VolumeTypesApi.md#listvolumestypes) | **GET** /instance/v1/zones/{zone}/products/volumes | List volume types
*VolumesApi* | [**applyBlockMigration**](docs/Api/VolumesApi.md#applyblockmigration) | **POST** /instance/v1/zones/{zone}/block-migration/apply | Migrate a volume and/or snapshots to SBS (Scaleway Block Storage)
*VolumesApi* | [**createVolume**](docs/Api/VolumesApi.md#createvolume) | **POST** /instance/v1/zones/{zone}/volumes | Create a volume
*VolumesApi* | [**deleteVolume**](docs/Api/VolumesApi.md#deletevolume) | **DELETE** /instance/v1/zones/{zone}/volumes/{volume_id} | Delete a volume
*VolumesApi* | [**getVolume**](docs/Api/VolumesApi.md#getvolume) | **GET** /instance/v1/zones/{zone}/volumes/{volume_id} | Get a volume
*VolumesApi* | [**listVolumes**](docs/Api/VolumesApi.md#listvolumes) | **GET** /instance/v1/zones/{zone}/volumes | List volumes
*VolumesApi* | [**planBlockMigration**](docs/Api/VolumesApi.md#planblockmigration) | **POST** /instance/v1/zones/{zone}/block-migration/plan | Get a volume or snapshot&#39;s migration plan
*VolumesApi* | [**setVolume**](docs/Api/VolumesApi.md#setvolume) | **PUT** /instance/v1/zones/{zone}/volumes/{id} | Update volume
*VolumesApi* | [**updateVolume**](docs/Api/VolumesApi.md#updatevolume) | **PATCH** /instance/v1/zones/{zone}/volumes/{volume_id} | Update a volume

## Models

- [ApplyBlockMigrationRequest](docs/Model/ApplyBlockMigrationRequest.md)
- [AttachServerVolumeRequest](docs/Model/AttachServerVolumeRequest.md)
- [CreateImageRequest](docs/Model/CreateImageRequest.md)
- [CreateImageRequestExtraVolumes](docs/Model/CreateImageRequestExtraVolumes.md)
- [CreateIpRequest](docs/Model/CreateIpRequest.md)
- [CreatePlacementGroupRequest](docs/Model/CreatePlacementGroupRequest.md)
- [CreatePrivateNICRequest](docs/Model/CreatePrivateNICRequest.md)
- [CreateSecurityGroupRequest](docs/Model/CreateSecurityGroupRequest.md)
- [CreateSecurityGroupRuleRequest](docs/Model/CreateSecurityGroupRuleRequest.md)
- [CreateServerRequest](docs/Model/CreateServerRequest.md)
- [CreateServerRequestVolumes](docs/Model/CreateServerRequestVolumes.md)
- [CreateSnapshotRequest](docs/Model/CreateSnapshotRequest.md)
- [CreateVolumeRequest](docs/Model/CreateVolumeRequest.md)
- [DetachServerVolumeRequest](docs/Model/DetachServerVolumeRequest.md)
- [ExportSnapshotRequest](docs/Model/ExportSnapshotRequest.md)
- [PlanBlockMigrationRequest](docs/Model/PlanBlockMigrationRequest.md)
- [ScalewayInstanceV1Arch](docs/Model/ScalewayInstanceV1Arch.md)
- [ScalewayInstanceV1AttachServerVolumeRequestVolumeType](docs/Model/ScalewayInstanceV1AttachServerVolumeRequestVolumeType.md)
- [ScalewayInstanceV1AttachServerVolumeResponse](docs/Model/ScalewayInstanceV1AttachServerVolumeResponse.md)
- [ScalewayInstanceV1BootType](docs/Model/ScalewayInstanceV1BootType.md)
- [ScalewayInstanceV1Bootscript](docs/Model/ScalewayInstanceV1Bootscript.md)
- [ScalewayInstanceV1CreateImageResponse](docs/Model/ScalewayInstanceV1CreateImageResponse.md)
- [ScalewayInstanceV1CreateIpResponse](docs/Model/ScalewayInstanceV1CreateIpResponse.md)
- [ScalewayInstanceV1CreatePlacementGroupResponse](docs/Model/ScalewayInstanceV1CreatePlacementGroupResponse.md)
- [ScalewayInstanceV1CreatePrivateNICResponse](docs/Model/ScalewayInstanceV1CreatePrivateNICResponse.md)
- [ScalewayInstanceV1CreateSecurityGroupResponse](docs/Model/ScalewayInstanceV1CreateSecurityGroupResponse.md)
- [ScalewayInstanceV1CreateSecurityGroupRuleResponse](docs/Model/ScalewayInstanceV1CreateSecurityGroupRuleResponse.md)
- [ScalewayInstanceV1CreateServerResponse](docs/Model/ScalewayInstanceV1CreateServerResponse.md)
- [ScalewayInstanceV1CreateSnapshotResponse](docs/Model/ScalewayInstanceV1CreateSnapshotResponse.md)
- [ScalewayInstanceV1CreateVolumeResponse](docs/Model/ScalewayInstanceV1CreateVolumeResponse.md)
- [ScalewayInstanceV1Dashboard](docs/Model/ScalewayInstanceV1Dashboard.md)
- [ScalewayInstanceV1DashboardServersByTypes](docs/Model/ScalewayInstanceV1DashboardServersByTypes.md)
- [ScalewayInstanceV1DetachServerVolumeResponse](docs/Model/ScalewayInstanceV1DetachServerVolumeResponse.md)
- [ScalewayInstanceV1ExportSnapshotResponse](docs/Model/ScalewayInstanceV1ExportSnapshotResponse.md)
- [ScalewayInstanceV1GetBootscriptResponse](docs/Model/ScalewayInstanceV1GetBootscriptResponse.md)
- [ScalewayInstanceV1GetDashboardResponse](docs/Model/ScalewayInstanceV1GetDashboardResponse.md)
- [ScalewayInstanceV1GetImageResponse](docs/Model/ScalewayInstanceV1GetImageResponse.md)
- [ScalewayInstanceV1GetIpResponse](docs/Model/ScalewayInstanceV1GetIpResponse.md)
- [ScalewayInstanceV1GetPlacementGroupResponse](docs/Model/ScalewayInstanceV1GetPlacementGroupResponse.md)
- [ScalewayInstanceV1GetPlacementGroupServersResponse](docs/Model/ScalewayInstanceV1GetPlacementGroupServersResponse.md)
- [ScalewayInstanceV1GetPrivateNICResponse](docs/Model/ScalewayInstanceV1GetPrivateNICResponse.md)
- [ScalewayInstanceV1GetSecurityGroupResponse](docs/Model/ScalewayInstanceV1GetSecurityGroupResponse.md)
- [ScalewayInstanceV1GetSecurityGroupRuleResponse](docs/Model/ScalewayInstanceV1GetSecurityGroupRuleResponse.md)
- [ScalewayInstanceV1GetServerResponse](docs/Model/ScalewayInstanceV1GetServerResponse.md)
- [ScalewayInstanceV1GetServerTypesAvailabilityResponse](docs/Model/ScalewayInstanceV1GetServerTypesAvailabilityResponse.md)
- [ScalewayInstanceV1GetServerTypesAvailabilityResponseAvailability](docs/Model/ScalewayInstanceV1GetServerTypesAvailabilityResponseAvailability.md)
- [ScalewayInstanceV1GetServerTypesAvailabilityResponseServers](docs/Model/ScalewayInstanceV1GetServerTypesAvailabilityResponseServers.md)
- [ScalewayInstanceV1GetSnapshotResponse](docs/Model/ScalewayInstanceV1GetSnapshotResponse.md)
- [ScalewayInstanceV1GetVolumeResponse](docs/Model/ScalewayInstanceV1GetVolumeResponse.md)
- [ScalewayInstanceV1Image](docs/Model/ScalewayInstanceV1Image.md)
- [ScalewayInstanceV1ImageState](docs/Model/ScalewayInstanceV1ImageState.md)
- [ScalewayInstanceV1Ip](docs/Model/ScalewayInstanceV1Ip.md)
- [ScalewayInstanceV1IpState](docs/Model/ScalewayInstanceV1IpState.md)
- [ScalewayInstanceV1IpType](docs/Model/ScalewayInstanceV1IpType.md)
- [ScalewayInstanceV1ListBootscriptsResponse](docs/Model/ScalewayInstanceV1ListBootscriptsResponse.md)
- [ScalewayInstanceV1ListImagesResponse](docs/Model/ScalewayInstanceV1ListImagesResponse.md)
- [ScalewayInstanceV1ListIpsResponse](docs/Model/ScalewayInstanceV1ListIpsResponse.md)
- [ScalewayInstanceV1ListPlacementGroupsResponse](docs/Model/ScalewayInstanceV1ListPlacementGroupsResponse.md)
- [ScalewayInstanceV1ListPrivateNICsResponse](docs/Model/ScalewayInstanceV1ListPrivateNICsResponse.md)
- [ScalewayInstanceV1ListSecurityGroupRulesResponse](docs/Model/ScalewayInstanceV1ListSecurityGroupRulesResponse.md)
- [ScalewayInstanceV1ListSecurityGroupsResponse](docs/Model/ScalewayInstanceV1ListSecurityGroupsResponse.md)
- [ScalewayInstanceV1ListServerActionsResponse](docs/Model/ScalewayInstanceV1ListServerActionsResponse.md)
- [ScalewayInstanceV1ListServerUserDataResponse](docs/Model/ScalewayInstanceV1ListServerUserDataResponse.md)
- [ScalewayInstanceV1ListServersResponse](docs/Model/ScalewayInstanceV1ListServersResponse.md)
- [ScalewayInstanceV1ListServersTypesResponse](docs/Model/ScalewayInstanceV1ListServersTypesResponse.md)
- [ScalewayInstanceV1ListServersTypesResponseServers](docs/Model/ScalewayInstanceV1ListServersTypesResponseServers.md)
- [ScalewayInstanceV1ListSnapshotsResponse](docs/Model/ScalewayInstanceV1ListSnapshotsResponse.md)
- [ScalewayInstanceV1ListVolumesResponse](docs/Model/ScalewayInstanceV1ListVolumesResponse.md)
- [ScalewayInstanceV1ListVolumesTypesResponse](docs/Model/ScalewayInstanceV1ListVolumesTypesResponse.md)
- [ScalewayInstanceV1ListVolumesTypesResponseVolumes](docs/Model/ScalewayInstanceV1ListVolumesTypesResponseVolumes.md)
- [ScalewayInstanceV1MigrationPlan](docs/Model/ScalewayInstanceV1MigrationPlan.md)
- [ScalewayInstanceV1MigrationPlanVolume](docs/Model/ScalewayInstanceV1MigrationPlanVolume.md)
- [ScalewayInstanceV1PlacementGroup](docs/Model/ScalewayInstanceV1PlacementGroup.md)
- [ScalewayInstanceV1PlacementGroupPolicyMode](docs/Model/ScalewayInstanceV1PlacementGroupPolicyMode.md)
- [ScalewayInstanceV1PlacementGroupPolicyType](docs/Model/ScalewayInstanceV1PlacementGroupPolicyType.md)
- [ScalewayInstanceV1PlacementGroupServer](docs/Model/ScalewayInstanceV1PlacementGroupServer.md)
- [ScalewayInstanceV1PrivateNIC](docs/Model/ScalewayInstanceV1PrivateNIC.md)
- [ScalewayInstanceV1SecurityGroup](docs/Model/ScalewayInstanceV1SecurityGroup.md)
- [ScalewayInstanceV1SecurityGroupRule](docs/Model/ScalewayInstanceV1SecurityGroupRule.md)
- [ScalewayInstanceV1SecurityGroupRuleAction](docs/Model/ScalewayInstanceV1SecurityGroupRuleAction.md)
- [ScalewayInstanceV1SecurityGroupRuleDirection](docs/Model/ScalewayInstanceV1SecurityGroupRuleDirection.md)
- [ScalewayInstanceV1SecurityGroupRuleProtocol](docs/Model/ScalewayInstanceV1SecurityGroupRuleProtocol.md)
- [ScalewayInstanceV1SecurityGroupTemplate](docs/Model/ScalewayInstanceV1SecurityGroupTemplate.md)
- [ScalewayInstanceV1Server](docs/Model/ScalewayInstanceV1Server.md)
- [ScalewayInstanceV1ServerAction](docs/Model/ScalewayInstanceV1ServerAction.md)
- [ScalewayInstanceV1ServerActionRequestVolumeBackupTemplate](docs/Model/ScalewayInstanceV1ServerActionRequestVolumeBackupTemplate.md)
- [ScalewayInstanceV1ServerActionResponse](docs/Model/ScalewayInstanceV1ServerActionResponse.md)
- [ScalewayInstanceV1ServerBootscript](docs/Model/ScalewayInstanceV1ServerBootscript.md)
- [ScalewayInstanceV1ServerImage](docs/Model/ScalewayInstanceV1ServerImage.md)
- [ScalewayInstanceV1ServerIp](docs/Model/ScalewayInstanceV1ServerIp.md)
- [ScalewayInstanceV1ServerIpv6](docs/Model/ScalewayInstanceV1ServerIpv6.md)
- [ScalewayInstanceV1ServerLocation](docs/Model/ScalewayInstanceV1ServerLocation.md)
- [ScalewayInstanceV1ServerMaintenance](docs/Model/ScalewayInstanceV1ServerMaintenance.md)
- [ScalewayInstanceV1ServerPlacementGroup](docs/Model/ScalewayInstanceV1ServerPlacementGroup.md)
- [ScalewayInstanceV1ServerPublicIp](docs/Model/ScalewayInstanceV1ServerPublicIp.md)
- [ScalewayInstanceV1ServerSecurityGroup](docs/Model/ScalewayInstanceV1ServerSecurityGroup.md)
- [ScalewayInstanceV1ServerSummary](docs/Model/ScalewayInstanceV1ServerSummary.md)
- [ScalewayInstanceV1ServerType](docs/Model/ScalewayInstanceV1ServerType.md)
- [ScalewayInstanceV1ServerTypeCapabilities](docs/Model/ScalewayInstanceV1ServerTypeCapabilities.md)
- [ScalewayInstanceV1ServerTypeNetwork](docs/Model/ScalewayInstanceV1ServerTypeNetwork.md)
- [ScalewayInstanceV1ServerTypeNetworkInterface](docs/Model/ScalewayInstanceV1ServerTypeNetworkInterface.md)
- [ScalewayInstanceV1ServerTypePerVolumeConstraint](docs/Model/ScalewayInstanceV1ServerTypePerVolumeConstraint.md)
- [ScalewayInstanceV1ServerTypePerVolumeConstraintLSsd](docs/Model/ScalewayInstanceV1ServerTypePerVolumeConstraintLSsd.md)
- [ScalewayInstanceV1ServerTypeVolumesConstraint](docs/Model/ScalewayInstanceV1ServerTypeVolumesConstraint.md)
- [ScalewayInstanceV1ServerTypesAvailability](docs/Model/ScalewayInstanceV1ServerTypesAvailability.md)
- [ScalewayInstanceV1ServerVolumes](docs/Model/ScalewayInstanceV1ServerVolumes.md)
- [ScalewayInstanceV1SetImageResponse](docs/Model/ScalewayInstanceV1SetImageResponse.md)
- [ScalewayInstanceV1SetPlacementGroupResponse](docs/Model/ScalewayInstanceV1SetPlacementGroupResponse.md)
- [ScalewayInstanceV1SetPlacementGroupServersResponse](docs/Model/ScalewayInstanceV1SetPlacementGroupServersResponse.md)
- [ScalewayInstanceV1SetSecurityGroupResponse](docs/Model/ScalewayInstanceV1SetSecurityGroupResponse.md)
- [ScalewayInstanceV1SetSecurityGroupRuleResponse](docs/Model/ScalewayInstanceV1SetSecurityGroupRuleResponse.md)
- [ScalewayInstanceV1SetSecurityGroupRulesRequestRule](docs/Model/ScalewayInstanceV1SetSecurityGroupRulesRequestRule.md)
- [ScalewayInstanceV1SetSecurityGroupRulesResponse](docs/Model/ScalewayInstanceV1SetSecurityGroupRulesResponse.md)
- [ScalewayInstanceV1SetSnapshotResponse](docs/Model/ScalewayInstanceV1SetSnapshotResponse.md)
- [ScalewayInstanceV1SetVolumeResponse](docs/Model/ScalewayInstanceV1SetVolumeResponse.md)
- [ScalewayInstanceV1Snapshot](docs/Model/ScalewayInstanceV1Snapshot.md)
- [ScalewayInstanceV1SnapshotBaseVolume](docs/Model/ScalewayInstanceV1SnapshotBaseVolume.md)
- [ScalewayInstanceV1SnapshotState](docs/Model/ScalewayInstanceV1SnapshotState.md)
- [ScalewayInstanceV1Task](docs/Model/ScalewayInstanceV1Task.md)
- [ScalewayInstanceV1UpdateImageResponse](docs/Model/ScalewayInstanceV1UpdateImageResponse.md)
- [ScalewayInstanceV1UpdateIpResponse](docs/Model/ScalewayInstanceV1UpdateIpResponse.md)
- [ScalewayInstanceV1UpdatePlacementGroupResponse](docs/Model/ScalewayInstanceV1UpdatePlacementGroupResponse.md)
- [ScalewayInstanceV1UpdatePlacementGroupServersResponse](docs/Model/ScalewayInstanceV1UpdatePlacementGroupServersResponse.md)
- [ScalewayInstanceV1UpdateSecurityGroupResponse](docs/Model/ScalewayInstanceV1UpdateSecurityGroupResponse.md)
- [ScalewayInstanceV1UpdateSecurityGroupRuleResponse](docs/Model/ScalewayInstanceV1UpdateSecurityGroupRuleResponse.md)
- [ScalewayInstanceV1UpdateServerResponse](docs/Model/ScalewayInstanceV1UpdateServerResponse.md)
- [ScalewayInstanceV1UpdateSnapshotResponse](docs/Model/ScalewayInstanceV1UpdateSnapshotResponse.md)
- [ScalewayInstanceV1UpdateVolumeResponse](docs/Model/ScalewayInstanceV1UpdateVolumeResponse.md)
- [ScalewayInstanceV1Volume](docs/Model/ScalewayInstanceV1Volume.md)
- [ScalewayInstanceV1VolumeImageUpdateTemplate](docs/Model/ScalewayInstanceV1VolumeImageUpdateTemplate.md)
- [ScalewayInstanceV1VolumeServer](docs/Model/ScalewayInstanceV1VolumeServer.md)
- [ScalewayInstanceV1VolumeServerState](docs/Model/ScalewayInstanceV1VolumeServerState.md)
- [ScalewayInstanceV1VolumeServerTemplate](docs/Model/ScalewayInstanceV1VolumeServerTemplate.md)
- [ScalewayInstanceV1VolumeServerVolumeType](docs/Model/ScalewayInstanceV1VolumeServerVolumeType.md)
- [ScalewayInstanceV1VolumeSummary](docs/Model/ScalewayInstanceV1VolumeSummary.md)
- [ScalewayInstanceV1VolumeTemplate](docs/Model/ScalewayInstanceV1VolumeTemplate.md)
- [ScalewayInstanceV1VolumeType](docs/Model/ScalewayInstanceV1VolumeType.md)
- [ScalewayInstanceV1VolumeTypeCapabilities](docs/Model/ScalewayInstanceV1VolumeTypeCapabilities.md)
- [ScalewayInstanceV1VolumeTypeConstraints](docs/Model/ScalewayInstanceV1VolumeTypeConstraints.md)
- [ScalewayInstanceV1VolumeVolumeType](docs/Model/ScalewayInstanceV1VolumeVolumeType.md)
- [ScalewayStdFile](docs/Model/ScalewayStdFile.md)
- [ServerActionRequest](docs/Model/ServerActionRequest.md)
- [ServerActionRequestVolumes](docs/Model/ServerActionRequestVolumes.md)
- [SetImageRequest](docs/Model/SetImageRequest.md)
- [SetImageRequestExtraVolumes](docs/Model/SetImageRequestExtraVolumes.md)
- [SetPlacementGroupRequest](docs/Model/SetPlacementGroupRequest.md)
- [SetPlacementGroupServersRequest](docs/Model/SetPlacementGroupServersRequest.md)
- [SetSecurityGroupRequest](docs/Model/SetSecurityGroupRequest.md)
- [SetSecurityGroupRuleRequest](docs/Model/SetSecurityGroupRuleRequest.md)
- [SetSecurityGroupRulesRequest](docs/Model/SetSecurityGroupRulesRequest.md)
- [SetSnapshotRequest](docs/Model/SetSnapshotRequest.md)
- [SetVolumeRequest](docs/Model/SetVolumeRequest.md)
- [SetVolumeRequestServer](docs/Model/SetVolumeRequestServer.md)
- [UpdateImageRequest](docs/Model/UpdateImageRequest.md)
- [UpdateImageRequestExtraVolumes](docs/Model/UpdateImageRequestExtraVolumes.md)
- [UpdateIpRequest](docs/Model/UpdateIpRequest.md)
- [UpdatePlacementGroupRequest](docs/Model/UpdatePlacementGroupRequest.md)
- [UpdatePrivateNICRequest](docs/Model/UpdatePrivateNICRequest.md)
- [UpdateSecurityGroupRequest](docs/Model/UpdateSecurityGroupRequest.md)
- [UpdateSecurityGroupRuleRequest](docs/Model/UpdateSecurityGroupRuleRequest.md)
- [UpdateServerRequest](docs/Model/UpdateServerRequest.md)
- [UpdateServerRequestVolumes](docs/Model/UpdateServerRequestVolumes.md)
- [UpdateSnapshotRequest](docs/Model/UpdateSnapshotRequest.md)
- [UpdateVolumeRequest](docs/Model/UpdateVolumeRequest.md)

## Authorization

Authentication schemes defined for the API:
### scaleway

- **Type**: API key
- **API key parameter name**: X-Auth-Token
- **Location**: HTTP header


## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author



## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `v1`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
