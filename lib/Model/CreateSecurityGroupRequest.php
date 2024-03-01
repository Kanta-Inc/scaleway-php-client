<?php
/**
 * CreateSecurityGroupRequest
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
 * CreateSecurityGroupRequest Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class CreateSecurityGroupRequest implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CreateSecurityGroup_request';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'name' => 'string',
        'description' => 'string',
        'organization' => 'string',
        'project' => 'string',
        'tags' => 'string[]',
        'organization_default' => 'bool',
        'project_default' => 'bool',
        'stateful' => 'bool',
        'inbound_default_policy' => 'string',
        'outbound_default_policy' => 'string',
        'enable_default_security' => 'bool'
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
        'description' => null,
        'organization' => null,
        'project' => null,
        'tags' => null,
        'organization_default' => null,
        'project_default' => null,
        'stateful' => null,
        'inbound_default_policy' => null,
        'outbound_default_policy' => null,
        'enable_default_security' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'name' => false,
        'description' => false,
        'organization' => false,
        'project' => false,
        'tags' => false,
        'organization_default' => false,
        'project_default' => false,
        'stateful' => false,
        'inbound_default_policy' => false,
        'outbound_default_policy' => false,
        'enable_default_security' => true
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
        'description' => 'description',
        'organization' => 'organization',
        'project' => 'project',
        'tags' => 'tags',
        'organization_default' => 'organization_default',
        'project_default' => 'project_default',
        'stateful' => 'stateful',
        'inbound_default_policy' => 'inbound_default_policy',
        'outbound_default_policy' => 'outbound_default_policy',
        'enable_default_security' => 'enable_default_security'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
        'description' => 'setDescription',
        'organization' => 'setOrganization',
        'project' => 'setProject',
        'tags' => 'setTags',
        'organization_default' => 'setOrganizationDefault',
        'project_default' => 'setProjectDefault',
        'stateful' => 'setStateful',
        'inbound_default_policy' => 'setInboundDefaultPolicy',
        'outbound_default_policy' => 'setOutboundDefaultPolicy',
        'enable_default_security' => 'setEnableDefaultSecurity'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
        'description' => 'getDescription',
        'organization' => 'getOrganization',
        'project' => 'getProject',
        'tags' => 'getTags',
        'organization_default' => 'getOrganizationDefault',
        'project_default' => 'getProjectDefault',
        'stateful' => 'getStateful',
        'inbound_default_policy' => 'getInboundDefaultPolicy',
        'outbound_default_policy' => 'getOutboundDefaultPolicy',
        'enable_default_security' => 'getEnableDefaultSecurity'
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

    public const INBOUND_DEFAULT_POLICY_UNKNOWN_POLICY = 'unknown_policy';
    public const INBOUND_DEFAULT_POLICY_ACCEPT = 'accept';
    public const INBOUND_DEFAULT_POLICY_DROP = 'drop';
    public const OUTBOUND_DEFAULT_POLICY_UNKNOWN_POLICY = 'unknown_policy';
    public const OUTBOUND_DEFAULT_POLICY_ACCEPT = 'accept';
    public const OUTBOUND_DEFAULT_POLICY_DROP = 'drop';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getInboundDefaultPolicyAllowableValues()
    {
        return [
            self::INBOUND_DEFAULT_POLICY_UNKNOWN_POLICY,
            self::INBOUND_DEFAULT_POLICY_ACCEPT,
            self::INBOUND_DEFAULT_POLICY_DROP,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getOutboundDefaultPolicyAllowableValues()
    {
        return [
            self::OUTBOUND_DEFAULT_POLICY_UNKNOWN_POLICY,
            self::OUTBOUND_DEFAULT_POLICY_ACCEPT,
            self::OUTBOUND_DEFAULT_POLICY_DROP,
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
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('organization', $data ?? [], null);
        $this->setIfExists('project', $data ?? [], null);
        $this->setIfExists('tags', $data ?? [], null);
        $this->setIfExists('organization_default', $data ?? [], false);
        $this->setIfExists('project_default', $data ?? [], false);
        $this->setIfExists('stateful', $data ?? [], false);
        $this->setIfExists('inbound_default_policy', $data ?? [], 'accept');
        $this->setIfExists('outbound_default_policy', $data ?? [], 'accept');
        $this->setIfExists('enable_default_security', $data ?? [], null);
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
        $allowedValues = $this->getInboundDefaultPolicyAllowableValues();
        if (!is_null($this->container['inbound_default_policy']) && !in_array($this->container['inbound_default_policy'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'inbound_default_policy', must be one of '%s'",
                $this->container['inbound_default_policy'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getOutboundDefaultPolicyAllowableValues();
        if (!is_null($this->container['outbound_default_policy']) && !in_array($this->container['outbound_default_policy'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'outbound_default_policy', must be one of '%s'",
                $this->container['outbound_default_policy'],
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
     * @param string $name Name of the security group.
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
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description Description of the security group.
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (is_null($description)) {
            throw new \InvalidArgumentException('non-nullable description cannot be null');
        }
        $this->container['description'] = $description;

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
     * @param string|null $organization Organization ID the security group belongs to.
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
     * @param string|null $project Project ID the security group belong to.
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
     * @param string[]|null $tags Tags of the security group.
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
     * Gets organization_default
     *
     * @return bool|null
     * @deprecated
     */
    public function getOrganizationDefault()
    {
        return $this->container['organization_default'];
    }

    /**
     * Sets organization_default
     *
     * @param bool|null $organization_default Defines whether this security group becomes the default security group for new Instances.
     *
     * @return self
     * @deprecated
     */
    public function setOrganizationDefault($organization_default)
    {
        if (is_null($organization_default)) {
            throw new \InvalidArgumentException('non-nullable organization_default cannot be null');
        }
        $this->container['organization_default'] = $organization_default;

        return $this;
    }

    /**
     * Gets project_default
     *
     * @return bool|null
     */
    public function getProjectDefault()
    {
        return $this->container['project_default'];
    }

    /**
     * Sets project_default
     *
     * @param bool|null $project_default Whether this security group becomes the default security group for new Instances.
     *
     * @return self
     */
    public function setProjectDefault($project_default)
    {
        if (is_null($project_default)) {
            throw new \InvalidArgumentException('non-nullable project_default cannot be null');
        }
        $this->container['project_default'] = $project_default;

        return $this;
    }

    /**
     * Gets stateful
     *
     * @return bool|null
     */
    public function getStateful()
    {
        return $this->container['stateful'];
    }

    /**
     * Sets stateful
     *
     * @param bool|null $stateful Whether the security group is stateful or not.
     *
     * @return self
     */
    public function setStateful($stateful)
    {
        if (is_null($stateful)) {
            throw new \InvalidArgumentException('non-nullable stateful cannot be null');
        }
        $this->container['stateful'] = $stateful;

        return $this;
    }

    /**
     * Gets inbound_default_policy
     *
     * @return string|null
     */
    public function getInboundDefaultPolicy()
    {
        return $this->container['inbound_default_policy'];
    }

    /**
     * Sets inbound_default_policy
     *
     * @param string|null $inbound_default_policy Default policy for inbound rules.
     *
     * @return self
     */
    public function setInboundDefaultPolicy($inbound_default_policy)
    {
        if (is_null($inbound_default_policy)) {
            throw new \InvalidArgumentException('non-nullable inbound_default_policy cannot be null');
        }
        $allowedValues = $this->getInboundDefaultPolicyAllowableValues();
        if (!in_array($inbound_default_policy, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'inbound_default_policy', must be one of '%s'",
                    $inbound_default_policy,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['inbound_default_policy'] = $inbound_default_policy;

        return $this;
    }

    /**
     * Gets outbound_default_policy
     *
     * @return string|null
     */
    public function getOutboundDefaultPolicy()
    {
        return $this->container['outbound_default_policy'];
    }

    /**
     * Sets outbound_default_policy
     *
     * @param string|null $outbound_default_policy Default policy for outbound rules.
     *
     * @return self
     */
    public function setOutboundDefaultPolicy($outbound_default_policy)
    {
        if (is_null($outbound_default_policy)) {
            throw new \InvalidArgumentException('non-nullable outbound_default_policy cannot be null');
        }
        $allowedValues = $this->getOutboundDefaultPolicyAllowableValues();
        if (!in_array($outbound_default_policy, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'outbound_default_policy', must be one of '%s'",
                    $outbound_default_policy,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['outbound_default_policy'] = $outbound_default_policy;

        return $this;
    }

    /**
     * Gets enable_default_security
     *
     * @return bool|null
     */
    public function getEnableDefaultSecurity()
    {
        return $this->container['enable_default_security'];
    }

    /**
     * Sets enable_default_security
     *
     * @param bool|null $enable_default_security True to block SMTP on IPv4 and IPv6. This feature is read only, please open a support ticket if you need to make it configurable.
     *
     * @return self
     */
    public function setEnableDefaultSecurity($enable_default_security)
    {
        if (is_null($enable_default_security)) {
            array_push($this->openAPINullablesSetToNull, 'enable_default_security');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('enable_default_security', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['enable_default_security'] = $enable_default_security;

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


