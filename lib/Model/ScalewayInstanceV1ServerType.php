<?php
/**
 * ScalewayInstanceV1ServerType
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
 * ScalewayInstanceV1ServerType Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ScalewayInstanceV1ServerType implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'scaleway.instance.v1.ServerType';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'monthly_price' => 'float',
        'hourly_price' => 'float',
        'alt_names' => 'string[]',
        'per_volume_constraint' => '\OpenAPI\Client\Model\ScalewayInstanceV1ServerTypePerVolumeConstraint',
        'volumes_constraint' => '\OpenAPI\Client\Model\ScalewayInstanceV1ServerTypeVolumesConstraint',
        'ncpus' => 'int',
        'gpu' => 'int',
        'ram' => 'int',
        'arch' => 'string',
        'baremetal' => 'bool',
        'network' => '\OpenAPI\Client\Model\ScalewayInstanceV1ServerTypeNetwork',
        'capabilities' => '\OpenAPI\Client\Model\ScalewayInstanceV1ServerTypeCapabilities',
        'scratch_storage_max_size' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'monthly_price' => 'float',
        'hourly_price' => 'float',
        'alt_names' => null,
        'per_volume_constraint' => null,
        'volumes_constraint' => null,
        'ncpus' => 'uint32',
        'gpu' => null,
        'ram' => 'uint64',
        'arch' => null,
        'baremetal' => null,
        'network' => null,
        'capabilities' => null,
        'scratch_storage_max_size' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'monthly_price' => false,
        'hourly_price' => false,
        'alt_names' => false,
        'per_volume_constraint' => false,
        'volumes_constraint' => false,
        'ncpus' => false,
        'gpu' => true,
        'ram' => false,
        'arch' => false,
        'baremetal' => false,
        'network' => false,
        'capabilities' => false,
        'scratch_storage_max_size' => true
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
        'monthly_price' => 'monthly_price',
        'hourly_price' => 'hourly_price',
        'alt_names' => 'alt_names',
        'per_volume_constraint' => 'per_volume_constraint',
        'volumes_constraint' => 'volumes_constraint',
        'ncpus' => 'ncpus',
        'gpu' => 'gpu',
        'ram' => 'ram',
        'arch' => 'arch',
        'baremetal' => 'baremetal',
        'network' => 'network',
        'capabilities' => 'capabilities',
        'scratch_storage_max_size' => 'scratch_storage_max_size'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'monthly_price' => 'setMonthlyPrice',
        'hourly_price' => 'setHourlyPrice',
        'alt_names' => 'setAltNames',
        'per_volume_constraint' => 'setPerVolumeConstraint',
        'volumes_constraint' => 'setVolumesConstraint',
        'ncpus' => 'setNcpus',
        'gpu' => 'setGpu',
        'ram' => 'setRam',
        'arch' => 'setArch',
        'baremetal' => 'setBaremetal',
        'network' => 'setNetwork',
        'capabilities' => 'setCapabilities',
        'scratch_storage_max_size' => 'setScratchStorageMaxSize'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'monthly_price' => 'getMonthlyPrice',
        'hourly_price' => 'getHourlyPrice',
        'alt_names' => 'getAltNames',
        'per_volume_constraint' => 'getPerVolumeConstraint',
        'volumes_constraint' => 'getVolumesConstraint',
        'ncpus' => 'getNcpus',
        'gpu' => 'getGpu',
        'ram' => 'getRam',
        'arch' => 'getArch',
        'baremetal' => 'getBaremetal',
        'network' => 'getNetwork',
        'capabilities' => 'getCapabilities',
        'scratch_storage_max_size' => 'getScratchStorageMaxSize'
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

    public const ARCH_UNKNOWN_ARCH = 'unknown_arch';
    public const ARCH_X86_64 = 'x86_64';
    public const ARCH_ARM = 'arm';
    public const ARCH_ARM64 = 'arm64';

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
        $this->setIfExists('monthly_price', $data ?? [], null);
        $this->setIfExists('hourly_price', $data ?? [], null);
        $this->setIfExists('alt_names', $data ?? [], null);
        $this->setIfExists('per_volume_constraint', $data ?? [], null);
        $this->setIfExists('volumes_constraint', $data ?? [], null);
        $this->setIfExists('ncpus', $data ?? [], null);
        $this->setIfExists('gpu', $data ?? [], null);
        $this->setIfExists('ram', $data ?? [], null);
        $this->setIfExists('arch', $data ?? [], 'unknown_arch');
        $this->setIfExists('baremetal', $data ?? [], null);
        $this->setIfExists('network', $data ?? [], null);
        $this->setIfExists('capabilities', $data ?? [], null);
        $this->setIfExists('scratch_storage_max_size', $data ?? [], null);
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
     * Gets monthly_price
     *
     * @return float|null
     * @deprecated
     */
    public function getMonthlyPrice()
    {
        return $this->container['monthly_price'];
    }

    /**
     * Sets monthly_price
     *
     * @param float|null $monthly_price Estimated monthly price, for a 30 days month, in Euro.
     *
     * @return self
     * @deprecated
     */
    public function setMonthlyPrice($monthly_price)
    {
        if (is_null($monthly_price)) {
            throw new \InvalidArgumentException('non-nullable monthly_price cannot be null');
        }
        $this->container['monthly_price'] = $monthly_price;

        return $this;
    }

    /**
     * Gets hourly_price
     *
     * @return float|null
     */
    public function getHourlyPrice()
    {
        return $this->container['hourly_price'];
    }

    /**
     * Sets hourly_price
     *
     * @param float|null $hourly_price Hourly price in Euro.
     *
     * @return self
     */
    public function setHourlyPrice($hourly_price)
    {
        if (is_null($hourly_price)) {
            throw new \InvalidArgumentException('non-nullable hourly_price cannot be null');
        }
        $this->container['hourly_price'] = $hourly_price;

        return $this;
    }

    /**
     * Gets alt_names
     *
     * @return string[]|null
     */
    public function getAltNames()
    {
        return $this->container['alt_names'];
    }

    /**
     * Sets alt_names
     *
     * @param string[]|null $alt_names Alternative Instance name, if any.
     *
     * @return self
     */
    public function setAltNames($alt_names)
    {
        if (is_null($alt_names)) {
            throw new \InvalidArgumentException('non-nullable alt_names cannot be null');
        }
        $this->container['alt_names'] = $alt_names;

        return $this;
    }

    /**
     * Gets per_volume_constraint
     *
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ServerTypePerVolumeConstraint|null
     */
    public function getPerVolumeConstraint()
    {
        return $this->container['per_volume_constraint'];
    }

    /**
     * Sets per_volume_constraint
     *
     * @param \OpenAPI\Client\Model\ScalewayInstanceV1ServerTypePerVolumeConstraint|null $per_volume_constraint per_volume_constraint
     *
     * @return self
     */
    public function setPerVolumeConstraint($per_volume_constraint)
    {
        if (is_null($per_volume_constraint)) {
            throw new \InvalidArgumentException('non-nullable per_volume_constraint cannot be null');
        }
        $this->container['per_volume_constraint'] = $per_volume_constraint;

        return $this;
    }

    /**
     * Gets volumes_constraint
     *
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ServerTypeVolumesConstraint|null
     */
    public function getVolumesConstraint()
    {
        return $this->container['volumes_constraint'];
    }

    /**
     * Sets volumes_constraint
     *
     * @param \OpenAPI\Client\Model\ScalewayInstanceV1ServerTypeVolumesConstraint|null $volumes_constraint volumes_constraint
     *
     * @return self
     */
    public function setVolumesConstraint($volumes_constraint)
    {
        if (is_null($volumes_constraint)) {
            throw new \InvalidArgumentException('non-nullable volumes_constraint cannot be null');
        }
        $this->container['volumes_constraint'] = $volumes_constraint;

        return $this;
    }

    /**
     * Gets ncpus
     *
     * @return int|null
     */
    public function getNcpus()
    {
        return $this->container['ncpus'];
    }

    /**
     * Sets ncpus
     *
     * @param int|null $ncpus Number of CPU.
     *
     * @return self
     */
    public function setNcpus($ncpus)
    {
        if (is_null($ncpus)) {
            throw new \InvalidArgumentException('non-nullable ncpus cannot be null');
        }
        $this->container['ncpus'] = $ncpus;

        return $this;
    }

    /**
     * Gets gpu
     *
     * @return int|null
     */
    public function getGpu()
    {
        return $this->container['gpu'];
    }

    /**
     * Sets gpu
     *
     * @param int|null $gpu Number of GPU.
     *
     * @return self
     */
    public function setGpu($gpu)
    {
        if (is_null($gpu)) {
            array_push($this->openAPINullablesSetToNull, 'gpu');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('gpu', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['gpu'] = $gpu;

        return $this;
    }

    /**
     * Gets ram
     *
     * @return int|null
     */
    public function getRam()
    {
        return $this->container['ram'];
    }

    /**
     * Sets ram
     *
     * @param int|null $ram Available RAM in bytes.
     *
     * @return self
     */
    public function setRam($ram)
    {
        if (is_null($ram)) {
            throw new \InvalidArgumentException('non-nullable ram cannot be null');
        }
        $this->container['ram'] = $ram;

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
     * @param string|null $arch CPU architecture.
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
     * Gets baremetal
     *
     * @return bool|null
     */
    public function getBaremetal()
    {
        return $this->container['baremetal'];
    }

    /**
     * Sets baremetal
     *
     * @param bool|null $baremetal True if it is a baremetal Instance.
     *
     * @return self
     */
    public function setBaremetal($baremetal)
    {
        if (is_null($baremetal)) {
            throw new \InvalidArgumentException('non-nullable baremetal cannot be null');
        }
        $this->container['baremetal'] = $baremetal;

        return $this;
    }

    /**
     * Gets network
     *
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ServerTypeNetwork|null
     */
    public function getNetwork()
    {
        return $this->container['network'];
    }

    /**
     * Sets network
     *
     * @param \OpenAPI\Client\Model\ScalewayInstanceV1ServerTypeNetwork|null $network network
     *
     * @return self
     */
    public function setNetwork($network)
    {
        if (is_null($network)) {
            throw new \InvalidArgumentException('non-nullable network cannot be null');
        }
        $this->container['network'] = $network;

        return $this;
    }

    /**
     * Gets capabilities
     *
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ServerTypeCapabilities|null
     */
    public function getCapabilities()
    {
        return $this->container['capabilities'];
    }

    /**
     * Sets capabilities
     *
     * @param \OpenAPI\Client\Model\ScalewayInstanceV1ServerTypeCapabilities|null $capabilities capabilities
     *
     * @return self
     */
    public function setCapabilities($capabilities)
    {
        if (is_null($capabilities)) {
            throw new \InvalidArgumentException('non-nullable capabilities cannot be null');
        }
        $this->container['capabilities'] = $capabilities;

        return $this;
    }

    /**
     * Gets scratch_storage_max_size
     *
     * @return int|null
     */
    public function getScratchStorageMaxSize()
    {
        return $this->container['scratch_storage_max_size'];
    }

    /**
     * Sets scratch_storage_max_size
     *
     * @param int|null $scratch_storage_max_size Maximum available scratch storage. (in bytes)
     *
     * @return self
     */
    public function setScratchStorageMaxSize($scratch_storage_max_size)
    {
        if (is_null($scratch_storage_max_size)) {
            array_push($this->openAPINullablesSetToNull, 'scratch_storage_max_size');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('scratch_storage_max_size', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['scratch_storage_max_size'] = $scratch_storage_max_size;

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


