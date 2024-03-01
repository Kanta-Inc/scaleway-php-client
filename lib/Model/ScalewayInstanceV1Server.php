<?php
/**
 * ScalewayInstanceV1Server
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Instance API
 *
 * Scaleway Instances are virtual machines in the cloud. Different [Instance types](https://www.scaleway.com/en/docs/compute/instances/reference-content/choosing-instance-type/) offer different technical specifications in terms of vCPU, RAM, bandwidth and storage. Once you have created your Instance and installed your image of choice (e.g. an operating system), you can [connect to your Instance via SSH](https://www.scaleway.com/en/docs/compute/instances/how-to/connect-to-instance/) to use it as you wish. When you are done using the Instance, you can delete it from your account.  (switchcolumn) <Message type=\"tip\"> To retrieve information about the different [images](#path-images) available to install on Scaleway Instances, check out our [Marketplace API](https://www.scaleway.com/en/developers/api/marketplace). </Message> (switchcolumn)   ## Concepts  Refer to our [dedicated concepts page](https://www.scaleway.com/en/docs/compute/instances/concepts/) to find definitions of all concepts and terminology related to Instances.  (switchcolumn) (switchcolumn)  ## Quickstart  1. Configure your environment variables      <Message type=\"note\">      This is an optional step that seeks to simplify your usage of the Instances API. See [Availability Zones](#availability-zones) below for help choosing an Availability Zone. You can find your Project ID in the [Scaleway console](https://console.scaleway.com/project/settings).     </Message>      ```bash     export SCW_SECRET_KEY=\"<API secret key>\"     export SCW_DEFAULT_ZONE=\"<Scaleway Availability Zone>\"     export SCW_PROJECT_ID=\"<Scaleway Project ID>\"     ```  2. **Create an Instance**: Run the following command to create an Instance. You can customize the details in the payload (name, description, type, tags etc) to your needs: use the information below to adjust the payload as necessary.      ```bash     curl -X POST \\       -H \"X-Auth-Token: $SCW_SECRET_KEY\" \\       -H \"Content-Type: application/json\" \\       \"https://api.scaleway.com/instance/v1/zones/$SCW_DEFAULT_ZONE/servers\" \\         -d '{           \"name\": \"my-new-instance\",            \"project\": \"'\"$SCW_PROJECT_ID\"'\",           \"commercial_type\": \"GP1-S\",            \"image\": \"544f0add-626b-4e4f-8a96-79fa4414d99a\",           \"enable_ipv6\": true,           \"volumes\": {             \"0\":{               \"name\": \"my-volume\",               \"size\": 300000000000,               \"volume_type\": \"l_ssd\"             }           }         }'     ```          | Parameter       | Description                                                                                                                                              | Valid values                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |     | --------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |     | `name`            | A name of your choice for the Instance (string)                                                                                                          | Any string containing only alphanumeric characters, dots, spaces and dashes, e.g. `\"my-new-instance\"`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          |     | `project`         | The Project in which the Instance should be created (string)                                                                                             | Any valid Scaleway Project ID (see above), e.g. `\"b4bd99e0-b389-11ed-afa1-0242ac120002\"`                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |     | `commercial-type` | The commercial Instance type to create (string)                                                                                                          | Any valid ID of a Scaleway commercial Instance type, e.g. `\"GP1-S\"`, `\"PRO2-M\"`. Use the [List Instance Types](#path-instance-types-list-instance-types) endpoint to get a list of all valid Instance types and their IDs.                                                                                                                                                                                                                                                                               |     | `image`           | The image to install on the Instance, e.g. a particular OS (string)                                                                                      | Any valid Scaleway image ID, e.g. `\"544f0add-626b-4e4f-8a96-79fa4414d99a\"` which is the ID for the `Ubuntu 22.04 Jammy Jellyfish` image. Use the [List Instance Images](#path-images-list-instance-images) endpoint to get a list of all available images and their IDs, or check out the [Scaleway Marketplace API](https://www.scaleway.com/en/developers/api/marketplace).                                                                                                                                                                                                                                                                                                     |     | `enable_ipv6`     | Whether to enable IPv6 on the Instance (boolean)                                                                                                         | `true` or `false`                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |     | `volumes`         | An object that specifies the storage volumes to attach to the Instance. For more information, see **Creating an Instance: the volumes object** in the [Technical information](#technical-information) section of this quickstart. | A (dictionary) object with a minimum of one key (`\"0\"`) whose value is another object containing the parameters `\"name\"` (a name for the volume), `\"size\"` (the size for the volume, in bytes), and `\"volume_type\"` (`\"l_ssd\"`, `\"b_ssd\"` or `\"unified\"`). Additional keys for additional volumes should increment by 1 each time (the second volume would have a key of `1`.) Further parameters are available, and it is possible to attach existing volumes rather than creating a new one, or create a volume from a snapshot. |  3. **List your Instances**: run the following command to get a list of all the Instances in your account, with their details:      ```bash     curl -X GET \\       -H \"Content-Type: application/json\" \\       -H \"X-Auth-Token: $SCW_SECRET_KEY\" \\       \"https://api.scaleway.com/instance/v1/zones/$SCW_DEFAULT_ZONE/servers/\"     ```  4. **Delete an Instance**: run the following command to delete an Instance, specified by its Instance ID:      ```bash     curl -X DELETE \\       -H \"X-Auth-Token: $SCW_SECRET_KEY\" \\       -H \"Content-Type: application/json\" \\       \"https://api.scaleway.com/instance/v1/zones/$SCW_DEFAULT_ZONE/servers/<Instance-ID>\"     ```      The expected successful response is empty.  (switchcolumn) <Message type=\"requirement\"> - You have a [Scaleway account](https://console.scaleway.com/) - You have created an [API key](https://www.scaleway.com/en/docs/identity-and-access-management/iam/how-to/create-api-keys/) and that the API key has sufficient [IAM permissions](https://www.scaleway.com/en/docs/identity-and-access-management/iam/reference-content/permission-sets/) to perform the actions described on this page - You have [installed `curl`](https://curl.se/download.html) </Message> (switchcolumn)  ## Technical information  ### Availability Zones  Instances can be deployed in the following Availability Zones:  | Name      | API ID                | |-----------|-----------------------| | Paris     | `fr-par-1` `fr-par-2` `fr-par-3` | | Amsterdam | `nl-ams-1` `nl-ams-2` | | Warsaw    | `pl-waw-1` `pl-waw-2` |  (switchcolumn) (switchcolumn)  ### Pagination  Most listing requests receive a paginated response. Requests against paginated endpoints accept two `query` arguments:  - `page`, a positive integer to choose which page to return. - `per_page`, an positive integer lower or equal to 100 to select the number of items to return per page. The default value is `50`.  Paginated endpoints usually also accept filters to search and sort results.These filters are documented along each endpoint documentation.  The `X-Total-Count` header contains the total number of items returned.  (switchcolumn) (switchcolumn)  ### Creating an Instance: the volumes object  When [creating an Instance](#path-instances-create-an-instance), the `volumes` object is a required part of the payload. This is a dictionary with a minimum of one key (`\"0\"`) whose value is another object setting parameters for that volume. Additional keys for additional volumes should increment by 1 each time (the second volume would have a key of `1`.)  Note that volume `size` must respect the volume constraints of the Instance's `commercial_type`: for each type of Instance, a minimum amount of storage is required, and there is also a maximum that cannot be exceeded. Some Instance types support only Block Storage (`b_ssd`), others also support local storage (`l_ssd`) ). Read more about these constraints in the [List Instance types](#path-instance-types-list-instance-types) documentation, specifically the `volume_constraints` parameter for each type listed in the response  You can use the `volumes` object in different ways. The table below shows which parameters are required for each of the following use cases:  | Use case                | Required params       | Optional params     | Notes                                  | |-------------------------|-----------------------|---------------------|----------------------------------------| | Create a volume from a snapshot of an image  |  | `volume_type`, `size`, `boot` | If the `size` parameter is not set, the size of the volume will equal the size of the corresponding snapshot of the image. | | Attach an existing volume   | `id`, `name` | `boot` |  | | Create an empty volume      | `name`, `volume_type`, `size` | `organization`, `project`, `boot` |  | | Create a volume from a snapshot     | `base_snapshot`, `name`, `volume_type` | `organization`, `project`, `boot` |  |  (switchcolumn) <Message type=\"note\"> This information is designed to help you correctly configure the `volumes` object when using the [Create an Instance](#path-instances-create-an-instance) or [Update an Instance](#path-instances-update-an-instance) methods.  </Message> (switchcolumn)  ## Going further  For more help using Scaleway Instances, check out the following resources: - Our [main documentation](https://www.scaleway.com/en/docs/compute/instances/) - The #instance channel on our [Slack Community](https://www.scaleway.com/en/docs/tutorials/scaleway-slack-community/) - Our [support ticketing system](https://www.scaleway.com/en/docs/console/my-account/how-to/open-a-support-ticket/).
 *
 * The version of the OpenAPI document: v1
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 7.4.0-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPI\Client\Model;

use \ArrayAccess;
use \OpenAPI\Client\ObjectSerializer;

/**
 * ScalewayInstanceV1Server Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ScalewayInstanceV1Server implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'scaleway.instance.v1.Server';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'string',
        'name' => 'string',
        'organization' => 'string',
        'project' => 'string',
        'allowed_actions' => '\OpenAPI\Client\Model\ScalewayInstanceV1ServerAction[]',
        'tags' => 'string[]',
        'commercial_type' => 'string',
        'creation_date' => '\DateTime',
        'dynamic_ip_required' => 'bool',
        'routed_ip_enabled' => 'bool',
        'enable_ipv6' => 'bool',
        'hostname' => 'string',
        'image' => '\OpenAPI\Client\Model\ScalewayInstanceV1ServerImage',
        'protected' => 'bool',
        'private_ip' => 'string',
        'public_ip' => '\OpenAPI\Client\Model\ScalewayInstanceV1ServerPublicIp',
        'public_ips' => '\OpenAPI\Client\Model\ScalewayInstanceV1ServerIp[]',
        'mac_address' => 'string',
        'modification_date' => '\DateTime',
        'state' => 'string',
        'location' => '\OpenAPI\Client\Model\ScalewayInstanceV1ServerLocation',
        'ipv6' => '\OpenAPI\Client\Model\ScalewayInstanceV1ServerIpv6',
        'bootscript' => '\OpenAPI\Client\Model\ScalewayInstanceV1ServerBootscript',
        'boot_type' => 'string',
        'volumes' => '\OpenAPI\Client\Model\ScalewayInstanceV1ServerVolumes',
        'security_group' => '\OpenAPI\Client\Model\ScalewayInstanceV1ServerSecurityGroup',
        'maintenances' => '\OpenAPI\Client\Model\ScalewayInstanceV1ServerMaintenance[]',
        'state_detail' => 'string',
        'arch' => 'string',
        'placement_group' => '\OpenAPI\Client\Model\ScalewayInstanceV1ServerPlacementGroup',
        'private_nics' => '\OpenAPI\Client\Model\ScalewayInstanceV1PrivateNIC[]',
        'zone' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'id' => null,
        'name' => null,
        'organization' => null,
        'project' => null,
        'allowed_actions' => null,
        'tags' => null,
        'commercial_type' => null,
        'creation_date' => 'date-time',
        'dynamic_ip_required' => null,
        'routed_ip_enabled' => null,
        'enable_ipv6' => null,
        'hostname' => null,
        'image' => null,
        'protected' => null,
        'private_ip' => null,
        'public_ip' => null,
        'public_ips' => null,
        'mac_address' => null,
        'modification_date' => 'date-time',
        'state' => null,
        'location' => null,
        'ipv6' => null,
        'bootscript' => null,
        'boot_type' => null,
        'volumes' => null,
        'security_group' => null,
        'maintenances' => null,
        'state_detail' => null,
        'arch' => null,
        'placement_group' => null,
        'private_nics' => null,
        'zone' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
        'name' => false,
        'organization' => false,
        'project' => false,
        'allowed_actions' => false,
        'tags' => false,
        'commercial_type' => false,
        'creation_date' => true,
        'dynamic_ip_required' => false,
        'routed_ip_enabled' => false,
        'enable_ipv6' => false,
        'hostname' => false,
        'image' => false,
        'protected' => false,
        'private_ip' => true,
        'public_ip' => false,
        'public_ips' => false,
        'mac_address' => false,
        'modification_date' => true,
        'state' => false,
        'location' => false,
        'ipv6' => false,
        'bootscript' => false,
        'boot_type' => false,
        'volumes' => false,
        'security_group' => false,
        'maintenances' => false,
        'state_detail' => false,
        'arch' => false,
        'placement_group' => false,
        'private_nics' => false,
        'zone' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'id' => 'id',
        'name' => 'name',
        'organization' => 'organization',
        'project' => 'project',
        'allowed_actions' => 'allowed_actions',
        'tags' => 'tags',
        'commercial_type' => 'commercial_type',
        'creation_date' => 'creation_date',
        'dynamic_ip_required' => 'dynamic_ip_required',
        'routed_ip_enabled' => 'routed_ip_enabled',
        'enable_ipv6' => 'enable_ipv6',
        'hostname' => 'hostname',
        'image' => 'image',
        'protected' => 'protected',
        'private_ip' => 'private_ip',
        'public_ip' => 'public_ip',
        'public_ips' => 'public_ips',
        'mac_address' => 'mac_address',
        'modification_date' => 'modification_date',
        'state' => 'state',
        'location' => 'location',
        'ipv6' => 'ipv6',
        'bootscript' => 'bootscript',
        'boot_type' => 'boot_type',
        'volumes' => 'volumes',
        'security_group' => 'security_group',
        'maintenances' => 'maintenances',
        'state_detail' => 'state_detail',
        'arch' => 'arch',
        'placement_group' => 'placement_group',
        'private_nics' => 'private_nics',
        'zone' => 'zone'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'organization' => 'setOrganization',
        'project' => 'setProject',
        'allowed_actions' => 'setAllowedActions',
        'tags' => 'setTags',
        'commercial_type' => 'setCommercialType',
        'creation_date' => 'setCreationDate',
        'dynamic_ip_required' => 'setDynamicIpRequired',
        'routed_ip_enabled' => 'setRoutedIpEnabled',
        'enable_ipv6' => 'setEnableIpv6',
        'hostname' => 'setHostname',
        'image' => 'setImage',
        'protected' => 'setProtected',
        'private_ip' => 'setPrivateIp',
        'public_ip' => 'setPublicIp',
        'public_ips' => 'setPublicIps',
        'mac_address' => 'setMacAddress',
        'modification_date' => 'setModificationDate',
        'state' => 'setState',
        'location' => 'setLocation',
        'ipv6' => 'setIpv6',
        'bootscript' => 'setBootscript',
        'boot_type' => 'setBootType',
        'volumes' => 'setVolumes',
        'security_group' => 'setSecurityGroup',
        'maintenances' => 'setMaintenances',
        'state_detail' => 'setStateDetail',
        'arch' => 'setArch',
        'placement_group' => 'setPlacementGroup',
        'private_nics' => 'setPrivateNics',
        'zone' => 'setZone'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'organization' => 'getOrganization',
        'project' => 'getProject',
        'allowed_actions' => 'getAllowedActions',
        'tags' => 'getTags',
        'commercial_type' => 'getCommercialType',
        'creation_date' => 'getCreationDate',
        'dynamic_ip_required' => 'getDynamicIpRequired',
        'routed_ip_enabled' => 'getRoutedIpEnabled',
        'enable_ipv6' => 'getEnableIpv6',
        'hostname' => 'getHostname',
        'image' => 'getImage',
        'protected' => 'getProtected',
        'private_ip' => 'getPrivateIp',
        'public_ip' => 'getPublicIp',
        'public_ips' => 'getPublicIps',
        'mac_address' => 'getMacAddress',
        'modification_date' => 'getModificationDate',
        'state' => 'getState',
        'location' => 'getLocation',
        'ipv6' => 'getIpv6',
        'bootscript' => 'getBootscript',
        'boot_type' => 'getBootType',
        'volumes' => 'getVolumes',
        'security_group' => 'getSecurityGroup',
        'maintenances' => 'getMaintenances',
        'state_detail' => 'getStateDetail',
        'arch' => 'getArch',
        'placement_group' => 'getPlacementGroup',
        'private_nics' => 'getPrivateNics',
        'zone' => 'getZone'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    public const STATE_RUNNING = 'running';
    public const STATE_STOPPED = 'stopped';
    public const STATE_STOPPED_IN_PLACE = 'stopped in place';
    public const STATE_STARTING = 'starting';
    public const STATE_STOPPING = 'stopping';
    public const STATE_LOCKED = 'locked';
    public const BOOT_TYPE_LOCAL = 'local';
    public const BOOT_TYPE_BOOTSCRIPT = 'bootscript';
    public const BOOT_TYPE_RESCUE = 'rescue';
    public const ARCH_UNKNOWN_ARCH = 'unknown_arch';
    public const ARCH_X86_64 = 'x86_64';
    public const ARCH_ARM = 'arm';
    public const ARCH_ARM64 = 'arm64';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStateAllowableValues()
    {
        return [
            self::STATE_RUNNING,
            self::STATE_STOPPED,
            self::STATE_STOPPED_IN_PLACE,
            self::STATE_STARTING,
            self::STATE_STOPPING,
            self::STATE_LOCKED,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getBootTypeAllowableValues()
    {
        return [
            self::BOOT_TYPE_LOCAL,
            self::BOOT_TYPE_BOOTSCRIPT,
            self::BOOT_TYPE_RESCUE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getArchAllowableValues()
    {
        return [
            self::ARCH_UNKNOWN_ARCH,
            self::ARCH_X86_64,
            self::ARCH_ARM,
            self::ARCH_ARM64,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('organization', $data ?? [], null);
        $this->setIfExists('project', $data ?? [], null);
        $this->setIfExists('allowed_actions', $data ?? [], null);
        $this->setIfExists('tags', $data ?? [], null);
        $this->setIfExists('commercial_type', $data ?? [], null);
        $this->setIfExists('creation_date', $data ?? [], null);
        $this->setIfExists('dynamic_ip_required', $data ?? [], null);
        $this->setIfExists('routed_ip_enabled', $data ?? [], null);
        $this->setIfExists('enable_ipv6', $data ?? [], null);
        $this->setIfExists('hostname', $data ?? [], null);
        $this->setIfExists('image', $data ?? [], null);
        $this->setIfExists('protected', $data ?? [], null);
        $this->setIfExists('private_ip', $data ?? [], null);
        $this->setIfExists('public_ip', $data ?? [], null);
        $this->setIfExists('public_ips', $data ?? [], null);
        $this->setIfExists('mac_address', $data ?? [], null);
        $this->setIfExists('modification_date', $data ?? [], null);
        $this->setIfExists('state', $data ?? [], 'running');
        $this->setIfExists('location', $data ?? [], null);
        $this->setIfExists('ipv6', $data ?? [], null);
        $this->setIfExists('bootscript', $data ?? [], null);
        $this->setIfExists('boot_type', $data ?? [], 'local');
        $this->setIfExists('volumes', $data ?? [], null);
        $this->setIfExists('security_group', $data ?? [], null);
        $this->setIfExists('maintenances', $data ?? [], null);
        $this->setIfExists('state_detail', $data ?? [], null);
        $this->setIfExists('arch', $data ?? [], 'unknown_arch');
        $this->setIfExists('placement_group', $data ?? [], null);
        $this->setIfExists('private_nics', $data ?? [], null);
        $this->setIfExists('zone', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getStateAllowableValues();
        if (!is_null($this->container['state']) && !in_array($this->container['state'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'state', must be one of '%s'",
                $this->container['state'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getBootTypeAllowableValues();
        if (!is_null($this->container['boot_type']) && !in_array($this->container['boot_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'boot_type', must be one of '%s'",
                $this->container['boot_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getArchAllowableValues();
        if (!is_null($this->container['arch']) && !in_array($this->container['arch'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'arch', must be one of '%s'",
                $this->container['arch'],
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string|null $id Instance unique ID.
     *
     * @return self
     */
    public function setId($id)
    {
        if (is_null($id)) {
            throw new \InvalidArgumentException('non-nullable id cannot be null');
        }
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string|null $name Instance name.
     *
     * @return self
     */
    public function setName($name)
    {
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets organization
     *
     * @return string|null
     */
    public function getOrganization()
    {
        return $this->container['organization'];
    }

    /**
     * Sets organization
     *
     * @param string|null $organization Instance Organization ID.
     *
     * @return self
     */
    public function setOrganization($organization)
    {
        if (is_null($organization)) {
            throw new \InvalidArgumentException('non-nullable organization cannot be null');
        }
        $this->container['organization'] = $organization;

        return $this;
    }

    /**
     * Gets project
     *
     * @return string|null
     */
    public function getProject()
    {
        return $this->container['project'];
    }

    /**
     * Sets project
     *
     * @param string|null $project Instance Project ID.
     *
     * @return self
     */
    public function setProject($project)
    {
        if (is_null($project)) {
            throw new \InvalidArgumentException('non-nullable project cannot be null');
        }
        $this->container['project'] = $project;

        return $this;
    }

    /**
     * Gets allowed_actions
     *
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ServerAction[]|null
     */
    public function getAllowedActions()
    {
        return $this->container['allowed_actions'];
    }

    /**
     * Sets allowed_actions
     *
     * @param \OpenAPI\Client\Model\ScalewayInstanceV1ServerAction[]|null $allowed_actions List of allowed actions on the Instance.
     *
     * @return self
     */
    public function setAllowedActions($allowed_actions)
    {
        if (is_null($allowed_actions)) {
            throw new \InvalidArgumentException('non-nullable allowed_actions cannot be null');
        }
        $this->container['allowed_actions'] = $allowed_actions;

        return $this;
    }

    /**
     * Gets tags
     *
     * @return string[]|null
     */
    public function getTags()
    {
        return $this->container['tags'];
    }

    /**
     * Sets tags
     *
     * @param string[]|null $tags Tags associated with the Instance.
     *
     * @return self
     */
    public function setTags($tags)
    {
        if (is_null($tags)) {
            throw new \InvalidArgumentException('non-nullable tags cannot be null');
        }
        $this->container['tags'] = $tags;

        return $this;
    }

    /**
     * Gets commercial_type
     *
     * @return string|null
     */
    public function getCommercialType()
    {
        return $this->container['commercial_type'];
    }

    /**
     * Sets commercial_type
     *
     * @param string|null $commercial_type Instance commercial type (eg. GP1-M).
     *
     * @return self
     */
    public function setCommercialType($commercial_type)
    {
        if (is_null($commercial_type)) {
            throw new \InvalidArgumentException('non-nullable commercial_type cannot be null');
        }
        $this->container['commercial_type'] = $commercial_type;

        return $this;
    }

    /**
     * Gets creation_date
     *
     * @return \DateTime|null
     */
    public function getCreationDate()
    {
        return $this->container['creation_date'];
    }

    /**
     * Sets creation_date
     *
     * @param \DateTime|null $creation_date Instance creation date. (RFC 3339 format)
     *
     * @return self
     */
    public function setCreationDate($creation_date)
    {
        if (is_null($creation_date)) {
            array_push($this->openAPINullablesSetToNull, 'creation_date');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('creation_date', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['creation_date'] = $creation_date;

        return $this;
    }

    /**
     * Gets dynamic_ip_required
     *
     * @return bool|null
     */
    public function getDynamicIpRequired()
    {
        return $this->container['dynamic_ip_required'];
    }

    /**
     * Sets dynamic_ip_required
     *
     * @param bool|null $dynamic_ip_required True if a dynamic IPv4 is required.
     *
     * @return self
     */
    public function setDynamicIpRequired($dynamic_ip_required)
    {
        if (is_null($dynamic_ip_required)) {
            throw new \InvalidArgumentException('non-nullable dynamic_ip_required cannot be null');
        }
        $this->container['dynamic_ip_required'] = $dynamic_ip_required;

        return $this;
    }

    /**
     * Gets routed_ip_enabled
     *
     * @return bool|null
     */
    public function getRoutedIpEnabled()
    {
        return $this->container['routed_ip_enabled'];
    }

    /**
     * Sets routed_ip_enabled
     *
     * @param bool|null $routed_ip_enabled True to configure the instance so it uses the new routed IP mode.
     *
     * @return self
     */
    public function setRoutedIpEnabled($routed_ip_enabled)
    {
        if (is_null($routed_ip_enabled)) {
            throw new \InvalidArgumentException('non-nullable routed_ip_enabled cannot be null');
        }
        $this->container['routed_ip_enabled'] = $routed_ip_enabled;

        return $this;
    }

    /**
     * Gets enable_ipv6
     *
     * @return bool|null
     */
    public function getEnableIpv6()
    {
        return $this->container['enable_ipv6'];
    }

    /**
     * Sets enable_ipv6
     *
     * @param bool|null $enable_ipv6 True if IPv6 is enabled.
     *
     * @return self
     */
    public function setEnableIpv6($enable_ipv6)
    {
        if (is_null($enable_ipv6)) {
            throw new \InvalidArgumentException('non-nullable enable_ipv6 cannot be null');
        }
        $this->container['enable_ipv6'] = $enable_ipv6;

        return $this;
    }

    /**
     * Gets hostname
     *
     * @return string|null
     */
    public function getHostname()
    {
        return $this->container['hostname'];
    }

    /**
     * Sets hostname
     *
     * @param string|null $hostname Instance host name.
     *
     * @return self
     */
    public function setHostname($hostname)
    {
        if (is_null($hostname)) {
            throw new \InvalidArgumentException('non-nullable hostname cannot be null');
        }
        $this->container['hostname'] = $hostname;

        return $this;
    }

    /**
     * Gets image
     *
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ServerImage|null
     */
    public function getImage()
    {
        return $this->container['image'];
    }

    /**
     * Sets image
     *
     * @param \OpenAPI\Client\Model\ScalewayInstanceV1ServerImage|null $image image
     *
     * @return self
     */
    public function setImage($image)
    {
        if (is_null($image)) {
            throw new \InvalidArgumentException('non-nullable image cannot be null');
        }
        $this->container['image'] = $image;

        return $this;
    }

    /**
     * Gets protected
     *
     * @return bool|null
     */
    public function getProtected()
    {
        return $this->container['protected'];
    }

    /**
     * Sets protected
     *
     * @param bool|null $protected Defines whether the Instance protection option is activated.
     *
     * @return self
     */
    public function setProtected($protected)
    {
        if (is_null($protected)) {
            throw new \InvalidArgumentException('non-nullable protected cannot be null');
        }
        $this->container['protected'] = $protected;

        return $this;
    }

    /**
     * Gets private_ip
     *
     * @return string|null
     */
    public function getPrivateIp()
    {
        return $this->container['private_ip'];
    }

    /**
     * Sets private_ip
     *
     * @param string|null $private_ip Private IP address of the Instance.
     *
     * @return self
     */
    public function setPrivateIp($private_ip)
    {
        if (is_null($private_ip)) {
            array_push($this->openAPINullablesSetToNull, 'private_ip');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('private_ip', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['private_ip'] = $private_ip;

        return $this;
    }

    /**
     * Gets public_ip
     *
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ServerPublicIp|null
     */
    public function getPublicIp()
    {
        return $this->container['public_ip'];
    }

    /**
     * Sets public_ip
     *
     * @param \OpenAPI\Client\Model\ScalewayInstanceV1ServerPublicIp|null $public_ip public_ip
     *
     * @return self
     */
    public function setPublicIp($public_ip)
    {
        if (is_null($public_ip)) {
            throw new \InvalidArgumentException('non-nullable public_ip cannot be null');
        }
        $this->container['public_ip'] = $public_ip;

        return $this;
    }

    /**
     * Gets public_ips
     *
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ServerIp[]|null
     */
    public function getPublicIps()
    {
        return $this->container['public_ips'];
    }

    /**
     * Sets public_ips
     *
     * @param \OpenAPI\Client\Model\ScalewayInstanceV1ServerIp[]|null $public_ips Information about all the public IPs attached to the server.
     *
     * @return self
     */
    public function setPublicIps($public_ips)
    {
        if (is_null($public_ips)) {
            throw new \InvalidArgumentException('non-nullable public_ips cannot be null');
        }
        $this->container['public_ips'] = $public_ips;

        return $this;
    }

    /**
     * Gets mac_address
     *
     * @return string|null
     */
    public function getMacAddress()
    {
        return $this->container['mac_address'];
    }

    /**
     * Sets mac_address
     *
     * @param string|null $mac_address The server's MAC address.
     *
     * @return self
     */
    public function setMacAddress($mac_address)
    {
        if (is_null($mac_address)) {
            throw new \InvalidArgumentException('non-nullable mac_address cannot be null');
        }
        $this->container['mac_address'] = $mac_address;

        return $this;
    }

    /**
     * Gets modification_date
     *
     * @return \DateTime|null
     */
    public function getModificationDate()
    {
        return $this->container['modification_date'];
    }

    /**
     * Sets modification_date
     *
     * @param \DateTime|null $modification_date Instance modification date. (RFC 3339 format)
     *
     * @return self
     */
    public function setModificationDate($modification_date)
    {
        if (is_null($modification_date)) {
            array_push($this->openAPINullablesSetToNull, 'modification_date');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('modification_date', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['modification_date'] = $modification_date;

        return $this;
    }

    /**
     * Gets state
     *
     * @return string|null
     */
    public function getState()
    {
        return $this->container['state'];
    }

    /**
     * Sets state
     *
     * @param string|null $state Instance state.
     *
     * @return self
     */
    public function setState($state)
    {
        if (is_null($state)) {
            throw new \InvalidArgumentException('non-nullable state cannot be null');
        }
        $allowedValues = $this->getStateAllowableValues();
        if (!in_array($state, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'state', must be one of '%s'",
                    $state,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['state'] = $state;

        return $this;
    }

    /**
     * Gets location
     *
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ServerLocation|null
     */
    public function getLocation()
    {
        return $this->container['location'];
    }

    /**
     * Sets location
     *
     * @param \OpenAPI\Client\Model\ScalewayInstanceV1ServerLocation|null $location location
     *
     * @return self
     */
    public function setLocation($location)
    {
        if (is_null($location)) {
            throw new \InvalidArgumentException('non-nullable location cannot be null');
        }
        $this->container['location'] = $location;

        return $this;
    }

    /**
     * Gets ipv6
     *
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ServerIpv6|null
     */
    public function getIpv6()
    {
        return $this->container['ipv6'];
    }

    /**
     * Sets ipv6
     *
     * @param \OpenAPI\Client\Model\ScalewayInstanceV1ServerIpv6|null $ipv6 ipv6
     *
     * @return self
     */
    public function setIpv6($ipv6)
    {
        if (is_null($ipv6)) {
            throw new \InvalidArgumentException('non-nullable ipv6 cannot be null');
        }
        $this->container['ipv6'] = $ipv6;

        return $this;
    }

    /**
     * Gets bootscript
     *
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ServerBootscript|null
     * @deprecated
     */
    public function getBootscript()
    {
        return $this->container['bootscript'];
    }

    /**
     * Sets bootscript
     *
     * @param \OpenAPI\Client\Model\ScalewayInstanceV1ServerBootscript|null $bootscript bootscript
     *
     * @return self
     * @deprecated
     */
    public function setBootscript($bootscript)
    {
        if (is_null($bootscript)) {
            throw new \InvalidArgumentException('non-nullable bootscript cannot be null');
        }
        $this->container['bootscript'] = $bootscript;

        return $this;
    }

    /**
     * Gets boot_type
     *
     * @return string|null
     */
    public function getBootType()
    {
        return $this->container['boot_type'];
    }

    /**
     * Sets boot_type
     *
     * @param string|null $boot_type Instance boot type.
     *
     * @return self
     */
    public function setBootType($boot_type)
    {
        if (is_null($boot_type)) {
            throw new \InvalidArgumentException('non-nullable boot_type cannot be null');
        }
        $allowedValues = $this->getBootTypeAllowableValues();
        if (!in_array($boot_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'boot_type', must be one of '%s'",
                    $boot_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['boot_type'] = $boot_type;

        return $this;
    }

    /**
     * Gets volumes
     *
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ServerVolumes|null
     */
    public function getVolumes()
    {
        return $this->container['volumes'];
    }

    /**
     * Sets volumes
     *
     * @param \OpenAPI\Client\Model\ScalewayInstanceV1ServerVolumes|null $volumes volumes
     *
     * @return self
     */
    public function setVolumes($volumes)
    {
        if (is_null($volumes)) {
            throw new \InvalidArgumentException('non-nullable volumes cannot be null');
        }
        $this->container['volumes'] = $volumes;

        return $this;
    }

    /**
     * Gets security_group
     *
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ServerSecurityGroup|null
     */
    public function getSecurityGroup()
    {
        return $this->container['security_group'];
    }

    /**
     * Sets security_group
     *
     * @param \OpenAPI\Client\Model\ScalewayInstanceV1ServerSecurityGroup|null $security_group security_group
     *
     * @return self
     */
    public function setSecurityGroup($security_group)
    {
        if (is_null($security_group)) {
            throw new \InvalidArgumentException('non-nullable security_group cannot be null');
        }
        $this->container['security_group'] = $security_group;

        return $this;
    }

    /**
     * Gets maintenances
     *
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ServerMaintenance[]|null
     */
    public function getMaintenances()
    {
        return $this->container['maintenances'];
    }

    /**
     * Sets maintenances
     *
     * @param \OpenAPI\Client\Model\ScalewayInstanceV1ServerMaintenance[]|null $maintenances Instance planned maintenance.
     *
     * @return self
     */
    public function setMaintenances($maintenances)
    {
        if (is_null($maintenances)) {
            throw new \InvalidArgumentException('non-nullable maintenances cannot be null');
        }
        $this->container['maintenances'] = $maintenances;

        return $this;
    }

    /**
     * Gets state_detail
     *
     * @return string|null
     */
    public function getStateDetail()
    {
        return $this->container['state_detail'];
    }

    /**
     * Sets state_detail
     *
     * @param string|null $state_detail Detailed information about the Instance state.
     *
     * @return self
     */
    public function setStateDetail($state_detail)
    {
        if (is_null($state_detail)) {
            throw new \InvalidArgumentException('non-nullable state_detail cannot be null');
        }
        $this->container['state_detail'] = $state_detail;

        return $this;
    }

    /**
     * Gets arch
     *
     * @return string|null
     */
    public function getArch()
    {
        return $this->container['arch'];
    }

    /**
     * Sets arch
     *
     * @param string|null $arch Instance architecture.
     *
     * @return self
     */
    public function setArch($arch)
    {
        if (is_null($arch)) {
            throw new \InvalidArgumentException('non-nullable arch cannot be null');
        }
        $allowedValues = $this->getArchAllowableValues();
        if (!in_array($arch, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'arch', must be one of '%s'",
                    $arch,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['arch'] = $arch;

        return $this;
    }

    /**
     * Gets placement_group
     *
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ServerPlacementGroup|null
     */
    public function getPlacementGroup()
    {
        return $this->container['placement_group'];
    }

    /**
     * Sets placement_group
     *
     * @param \OpenAPI\Client\Model\ScalewayInstanceV1ServerPlacementGroup|null $placement_group placement_group
     *
     * @return self
     */
    public function setPlacementGroup($placement_group)
    {
        if (is_null($placement_group)) {
            throw new \InvalidArgumentException('non-nullable placement_group cannot be null');
        }
        $this->container['placement_group'] = $placement_group;

        return $this;
    }

    /**
     * Gets private_nics
     *
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1PrivateNIC[]|null
     */
    public function getPrivateNics()
    {
        return $this->container['private_nics'];
    }

    /**
     * Sets private_nics
     *
     * @param \OpenAPI\Client\Model\ScalewayInstanceV1PrivateNIC[]|null $private_nics Instance private NICs.
     *
     * @return self
     */
    public function setPrivateNics($private_nics)
    {
        if (is_null($private_nics)) {
            throw new \InvalidArgumentException('non-nullable private_nics cannot be null');
        }
        $this->container['private_nics'] = $private_nics;

        return $this;
    }

    /**
     * Gets zone
     *
     * @return string|null
     */
    public function getZone()
    {
        return $this->container['zone'];
    }

    /**
     * Sets zone
     *
     * @param string|null $zone Zone in which the Instance is located.
     *
     * @return self
     */
    public function setZone($zone)
    {
        if (is_null($zone)) {
            throw new \InvalidArgumentException('non-nullable zone cannot be null');
        }
        $this->container['zone'] = $zone;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


