<?php
/**
 * CreateServerRequest
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
 * CreateServerRequest Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CreateServerRequest implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CreateServer_request';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'name' => 'string',
        'dynamic_ip_required' => 'bool',
        'routed_ip_enabled' => 'bool',
        'commercial_type' => 'string',
        'image' => 'string',
        'volumes' => '\OpenAPI\Client\Model\CreateServerRequestVolumes',
        'enable_ipv6' => 'bool',
        'public_ip' => 'string',
        'public_ips' => 'string[]',
        'boot_type' => 'string',
        'bootscript' => 'string',
        'organization' => 'string',
        'project' => 'string',
        'tags' => 'string[]',
        'security_group' => 'string',
        'placement_group' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'name' => null,
        'dynamic_ip_required' => null,
        'routed_ip_enabled' => null,
        'commercial_type' => null,
        'image' => null,
        'volumes' => null,
        'enable_ipv6' => null,
        'public_ip' => null,
        'public_ips' => null,
        'boot_type' => null,
        'bootscript' => null,
        'organization' => null,
        'project' => null,
        'tags' => null,
        'security_group' => null,
        'placement_group' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'name' => false,
        'dynamic_ip_required' => true,
        'routed_ip_enabled' => true,
        'commercial_type' => false,
        'image' => false,
        'volumes' => false,
        'enable_ipv6' => false,
        'public_ip' => true,
        'public_ips' => true,
        'boot_type' => false,
        'bootscript' => true,
        'organization' => false,
        'project' => false,
        'tags' => false,
        'security_group' => true,
        'placement_group' => true
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
        'name' => 'name',
        'dynamic_ip_required' => 'dynamic_ip_required',
        'routed_ip_enabled' => 'routed_ip_enabled',
        'commercial_type' => 'commercial_type',
        'image' => 'image',
        'volumes' => 'volumes',
        'enable_ipv6' => 'enable_ipv6',
        'public_ip' => 'public_ip',
        'public_ips' => 'public_ips',
        'boot_type' => 'boot_type',
        'bootscript' => 'bootscript',
        'organization' => 'organization',
        'project' => 'project',
        'tags' => 'tags',
        'security_group' => 'security_group',
        'placement_group' => 'placement_group'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
        'dynamic_ip_required' => 'setDynamicIpRequired',
        'routed_ip_enabled' => 'setRoutedIpEnabled',
        'commercial_type' => 'setCommercialType',
        'image' => 'setImage',
        'volumes' => 'setVolumes',
        'enable_ipv6' => 'setEnableIpv6',
        'public_ip' => 'setPublicIp',
        'public_ips' => 'setPublicIps',
        'boot_type' => 'setBootType',
        'bootscript' => 'setBootscript',
        'organization' => 'setOrganization',
        'project' => 'setProject',
        'tags' => 'setTags',
        'security_group' => 'setSecurityGroup',
        'placement_group' => 'setPlacementGroup'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
        'dynamic_ip_required' => 'getDynamicIpRequired',
        'routed_ip_enabled' => 'getRoutedIpEnabled',
        'commercial_type' => 'getCommercialType',
        'image' => 'getImage',
        'volumes' => 'getVolumes',
        'enable_ipv6' => 'getEnableIpv6',
        'public_ip' => 'getPublicIp',
        'public_ips' => 'getPublicIps',
        'boot_type' => 'getBootType',
        'bootscript' => 'getBootscript',
        'organization' => 'getOrganization',
        'project' => 'getProject',
        'tags' => 'getTags',
        'security_group' => 'getSecurityGroup',
        'placement_group' => 'getPlacementGroup'
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

    public const BOOT_TYPE_LOCAL = 'local';
    public const BOOT_TYPE_BOOTSCRIPT = 'bootscript';
    public const BOOT_TYPE_RESCUE = 'rescue';

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
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('dynamic_ip_required', $data ?? [], null);
        $this->setIfExists('routed_ip_enabled', $data ?? [], null);
        $this->setIfExists('commercial_type', $data ?? [], null);
        $this->setIfExists('image', $data ?? [], null);
        $this->setIfExists('volumes', $data ?? [], null);
        $this->setIfExists('enable_ipv6', $data ?? [], null);
        $this->setIfExists('public_ip', $data ?? [], null);
        $this->setIfExists('public_ips', $data ?? [], null);
        $this->setIfExists('boot_type', $data ?? [], 'local');
        $this->setIfExists('bootscript', $data ?? [], null);
        $this->setIfExists('organization', $data ?? [], null);
        $this->setIfExists('project', $data ?? [], null);
        $this->setIfExists('tags', $data ?? [], null);
        $this->setIfExists('security_group', $data ?? [], null);
        $this->setIfExists('placement_group', $data ?? [], null);
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

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['commercial_type'] === null) {
            $invalidProperties[] = "'commercial_type' can't be null";
        }
        $allowedValues = $this->getBootTypeAllowableValues();
        if (!is_null($this->container['boot_type']) && !in_array($this->container['boot_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'boot_type', must be one of '%s'",
                $this->container['boot_type'],
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
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name Instance name.
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
     * @param bool|null $dynamic_ip_required Define if a dynamic IPv4 is required for the Instance.
     *
     * @return self
     */
    public function setDynamicIpRequired($dynamic_ip_required)
    {
        if (is_null($dynamic_ip_required)) {
            array_push($this->openAPINullablesSetToNull, 'dynamic_ip_required');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('dynamic_ip_required', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
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
     * @param bool|null $routed_ip_enabled If true, configure the Instance so it uses the new routed IP mode.
     *
     * @return self
     */
    public function setRoutedIpEnabled($routed_ip_enabled)
    {
        if (is_null($routed_ip_enabled)) {
            array_push($this->openAPINullablesSetToNull, 'routed_ip_enabled');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('routed_ip_enabled', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['routed_ip_enabled'] = $routed_ip_enabled;

        return $this;
    }

    /**
     * Gets commercial_type
     *
     * @return string
     */
    public function getCommercialType()
    {
        return $this->container['commercial_type'];
    }

    /**
     * Sets commercial_type
     *
     * @param string $commercial_type Define the Instance commercial type (i.e. GP1-S).
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
     * Gets image
     *
     * @return string|null
     */
    public function getImage()
    {
        return $this->container['image'];
    }

    /**
     * Sets image
     *
     * @param string|null $image Instance image ID.
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
     * Gets volumes
     *
     * @return \OpenAPI\Client\Model\CreateServerRequestVolumes|null
     */
    public function getVolumes()
    {
        return $this->container['volumes'];
    }

    /**
     * Sets volumes
     *
     * @param \OpenAPI\Client\Model\CreateServerRequestVolumes|null $volumes volumes
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
     * @param bool|null $enable_ipv6 True if IPv6 is enabled on the server.
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
     * Gets public_ip
     *
     * @return string|null
     */
    public function getPublicIp()
    {
        return $this->container['public_ip'];
    }

    /**
     * Sets public_ip
     *
     * @param string|null $public_ip ID of the reserved IP to attach to the Instance.
     *
     * @return self
     */
    public function setPublicIp($public_ip)
    {
        if (is_null($public_ip)) {
            array_push($this->openAPINullablesSetToNull, 'public_ip');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('public_ip', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['public_ip'] = $public_ip;

        return $this;
    }

    /**
     * Gets public_ips
     *
     * @return string[]|null
     */
    public function getPublicIps()
    {
        return $this->container['public_ips'];
    }

    /**
     * Sets public_ips
     *
     * @param string[]|null $public_ips A list of reserved IP IDs to attach to the Instance.
     *
     * @return self
     */
    public function setPublicIps($public_ips)
    {
        if (is_null($public_ips)) {
            array_push($this->openAPINullablesSetToNull, 'public_ips');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('public_ips', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['public_ips'] = $public_ips;

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
     * @param string|null $boot_type Boot type to use.
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
     * Gets bootscript
     *
     * @return string|null
     * @deprecated
     */
    public function getBootscript()
    {
        return $this->container['bootscript'];
    }

    /**
     * Sets bootscript
     *
     * @param string|null $bootscript Bootscript ID to use when `boot_type` is set to `bootscript`.
     *
     * @return self
     * @deprecated
     */
    public function setBootscript($bootscript)
    {
        if (is_null($bootscript)) {
            array_push($this->openAPINullablesSetToNull, 'bootscript');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('bootscript', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['bootscript'] = $bootscript;

        return $this;
    }

    /**
     * Gets organization
     *
     * @return string|null
     * @deprecated
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
     * @deprecated
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
     * @param string[]|null $tags Instance tags.
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
     * Gets security_group
     *
     * @return string|null
     */
    public function getSecurityGroup()
    {
        return $this->container['security_group'];
    }

    /**
     * Sets security_group
     *
     * @param string|null $security_group Security group ID.
     *
     * @return self
     */
    public function setSecurityGroup($security_group)
    {
        if (is_null($security_group)) {
            array_push($this->openAPINullablesSetToNull, 'security_group');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('security_group', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['security_group'] = $security_group;

        return $this;
    }

    /**
     * Gets placement_group
     *
     * @return string|null
     */
    public function getPlacementGroup()
    {
        return $this->container['placement_group'];
    }

    /**
     * Sets placement_group
     *
     * @param string|null $placement_group Placement group ID if Instance must be part of a placement group.
     *
     * @return self
     */
    public function setPlacementGroup($placement_group)
    {
        if (is_null($placement_group)) {
            array_push($this->openAPINullablesSetToNull, 'placement_group');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('placement_group', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['placement_group'] = $placement_group;

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


