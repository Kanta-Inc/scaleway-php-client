<?php
/**
 * SecurityGroupsApi
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

namespace OpenAPI\Client\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\HeaderSelector;
use OpenAPI\Client\ObjectSerializer;

/**
 * SecurityGroupsApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class SecurityGroupsApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /** @var string[] $contentTypes **/
    public const contentTypes = [
        'createSecurityGroup' => [
            'application/json',
        ],
        'createSecurityGroupRule' => [
            'application/json',
        ],
        'deleteSecurityGroup' => [
            'application/json',
        ],
        'deleteSecurityGroupRule' => [
            'application/json',
        ],
        'getSecurityGroup' => [
            'application/json',
        ],
        'getSecurityGroupRule' => [
            'application/json',
        ],
        'listDefaultSecurityGroupRules' => [
            'application/json',
        ],
        'listSecurityGroupRules' => [
            'application/json',
        ],
        'listSecurityGroups' => [
            'application/json',
        ],
        'setSecurityGroup' => [
            'application/json',
        ],
        'setSecurityGroupRule' => [
            'application/json',
        ],
        'setSecurityGroupRules' => [
            'application/json',
        ],
        'updateSecurityGroup' => [
            'application/json',
        ],
        'updateSecurityGroupRule' => [
            'application/json',
        ],
    ];

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation createSecurityGroup
     *
     * Create a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  \OpenAPI\Client\Model\CreateSecurityGroupRequest $create_security_group_request create_security_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createSecurityGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupResponse
     */
    public function createSecurityGroup($zone, $create_security_group_request, string $contentType = self::contentTypes['createSecurityGroup'][0])
    {
        list($response) = $this->createSecurityGroupWithHttpInfo($zone, $create_security_group_request, $contentType);
        return $response;
    }

    /**
     * Operation createSecurityGroupWithHttpInfo
     *
     * Create a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  \OpenAPI\Client\Model\CreateSecurityGroupRequest $create_security_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createSecurityGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createSecurityGroupWithHttpInfo($zone, $create_security_group_request, string $contentType = self::contentTypes['createSecurityGroup'][0])
    {
        $request = $this->createSecurityGroupRequest($zone, $create_security_group_request, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 201:
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createSecurityGroupAsync
     *
     * Create a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  \OpenAPI\Client\Model\CreateSecurityGroupRequest $create_security_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createSecurityGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createSecurityGroupAsync($zone, $create_security_group_request, string $contentType = self::contentTypes['createSecurityGroup'][0])
    {
        return $this->createSecurityGroupAsyncWithHttpInfo($zone, $create_security_group_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createSecurityGroupAsyncWithHttpInfo
     *
     * Create a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  \OpenAPI\Client\Model\CreateSecurityGroupRequest $create_security_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createSecurityGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createSecurityGroupAsyncWithHttpInfo($zone, $create_security_group_request, string $contentType = self::contentTypes['createSecurityGroup'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupResponse';
        $request = $this->createSecurityGroupRequest($zone, $create_security_group_request, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'createSecurityGroup'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  \OpenAPI\Client\Model\CreateSecurityGroupRequest $create_security_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createSecurityGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createSecurityGroupRequest($zone, $create_security_group_request, string $contentType = self::contentTypes['createSecurityGroup'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling createSecurityGroup'
            );
        }

        // verify the required parameter 'create_security_group_request' is set
        if ($create_security_group_request === null || (is_array($create_security_group_request) && count($create_security_group_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $create_security_group_request when calling createSecurityGroup'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/security_groups';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($zone !== null) {
            $resourcePath = str_replace(
                '{' . 'zone' . '}',
                ObjectSerializer::toPathValue($zone),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($create_security_group_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($create_security_group_request));
            } else {
                $httpBody = $create_security_group_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Token');
        if ($apiKey !== null) {
            $headers['X-Auth-Token'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createSecurityGroupRule
     *
     * Create rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (required)
     * @param  \OpenAPI\Client\Model\CreateSecurityGroupRuleRequest $create_security_group_rule_request create_security_group_rule_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupRuleResponse
     */
    public function createSecurityGroupRule($zone, $security_group_id, $create_security_group_rule_request, string $contentType = self::contentTypes['createSecurityGroupRule'][0])
    {
        list($response) = $this->createSecurityGroupRuleWithHttpInfo($zone, $security_group_id, $create_security_group_rule_request, $contentType);
        return $response;
    }

    /**
     * Operation createSecurityGroupRuleWithHttpInfo
     *
     * Create rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (required)
     * @param  \OpenAPI\Client\Model\CreateSecurityGroupRuleRequest $create_security_group_rule_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupRuleResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createSecurityGroupRuleWithHttpInfo($zone, $security_group_id, $create_security_group_rule_request, string $contentType = self::contentTypes['createSecurityGroupRule'][0])
    {
        $request = $this->createSecurityGroupRuleRequest($zone, $security_group_id, $create_security_group_rule_request, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 201:
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupRuleResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupRuleResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupRuleResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupRuleResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupRuleResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createSecurityGroupRuleAsync
     *
     * Create rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (required)
     * @param  \OpenAPI\Client\Model\CreateSecurityGroupRuleRequest $create_security_group_rule_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createSecurityGroupRuleAsync($zone, $security_group_id, $create_security_group_rule_request, string $contentType = self::contentTypes['createSecurityGroupRule'][0])
    {
        return $this->createSecurityGroupRuleAsyncWithHttpInfo($zone, $security_group_id, $create_security_group_rule_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createSecurityGroupRuleAsyncWithHttpInfo
     *
     * Create rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (required)
     * @param  \OpenAPI\Client\Model\CreateSecurityGroupRuleRequest $create_security_group_rule_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createSecurityGroupRuleAsyncWithHttpInfo($zone, $security_group_id, $create_security_group_rule_request, string $contentType = self::contentTypes['createSecurityGroupRule'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1CreateSecurityGroupRuleResponse';
        $request = $this->createSecurityGroupRuleRequest($zone, $security_group_id, $create_security_group_rule_request, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'createSecurityGroupRule'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (required)
     * @param  \OpenAPI\Client\Model\CreateSecurityGroupRuleRequest $create_security_group_rule_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createSecurityGroupRuleRequest($zone, $security_group_id, $create_security_group_rule_request, string $contentType = self::contentTypes['createSecurityGroupRule'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling createSecurityGroupRule'
            );
        }

        // verify the required parameter 'security_group_id' is set
        if ($security_group_id === null || (is_array($security_group_id) && count($security_group_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $security_group_id when calling createSecurityGroupRule'
            );
        }

        // verify the required parameter 'create_security_group_rule_request' is set
        if ($create_security_group_rule_request === null || (is_array($create_security_group_rule_request) && count($create_security_group_rule_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $create_security_group_rule_request when calling createSecurityGroupRule'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/security_groups/{security_group_id}/rules';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($zone !== null) {
            $resourcePath = str_replace(
                '{' . 'zone' . '}',
                ObjectSerializer::toPathValue($zone),
                $resourcePath
            );
        }
        // path params
        if ($security_group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'security_group_id' . '}',
                ObjectSerializer::toPathValue($security_group_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($create_security_group_rule_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($create_security_group_rule_request));
            } else {
                $httpBody = $create_security_group_rule_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Token');
        if ($apiKey !== null) {
            $headers['X-Auth-Token'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteSecurityGroup
     *
     * Delete a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group you want to delete. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteSecurityGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteSecurityGroup($zone, $security_group_id, string $contentType = self::contentTypes['deleteSecurityGroup'][0])
    {
        $this->deleteSecurityGroupWithHttpInfo($zone, $security_group_id, $contentType);
    }

    /**
     * Operation deleteSecurityGroupWithHttpInfo
     *
     * Delete a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group you want to delete. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteSecurityGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteSecurityGroupWithHttpInfo($zone, $security_group_id, string $contentType = self::contentTypes['deleteSecurityGroup'][0])
    {
        $request = $this->deleteSecurityGroupRequest($zone, $security_group_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation deleteSecurityGroupAsync
     *
     * Delete a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group you want to delete. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteSecurityGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteSecurityGroupAsync($zone, $security_group_id, string $contentType = self::contentTypes['deleteSecurityGroup'][0])
    {
        return $this->deleteSecurityGroupAsyncWithHttpInfo($zone, $security_group_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteSecurityGroupAsyncWithHttpInfo
     *
     * Delete a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group you want to delete. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteSecurityGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteSecurityGroupAsyncWithHttpInfo($zone, $security_group_id, string $contentType = self::contentTypes['deleteSecurityGroup'][0])
    {
        $returnType = '';
        $request = $this->deleteSecurityGroupRequest($zone, $security_group_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteSecurityGroup'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group you want to delete. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteSecurityGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteSecurityGroupRequest($zone, $security_group_id, string $contentType = self::contentTypes['deleteSecurityGroup'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling deleteSecurityGroup'
            );
        }

        // verify the required parameter 'security_group_id' is set
        if ($security_group_id === null || (is_array($security_group_id) && count($security_group_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $security_group_id when calling deleteSecurityGroup'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/security_groups/{security_group_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($zone !== null) {
            $resourcePath = str_replace(
                '{' . 'zone' . '}',
                ObjectSerializer::toPathValue($zone),
                $resourcePath
            );
        }
        // path params
        if ($security_group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'security_group_id' . '}',
                ObjectSerializer::toPathValue($security_group_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Token');
        if ($apiKey !== null) {
            $headers['X-Auth-Token'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteSecurityGroupRule
     *
     * Delete rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id security_group_id (required)
     * @param  string $security_group_rule_id security_group_rule_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteSecurityGroupRule($zone, $security_group_id, $security_group_rule_id, string $contentType = self::contentTypes['deleteSecurityGroupRule'][0])
    {
        $this->deleteSecurityGroupRuleWithHttpInfo($zone, $security_group_id, $security_group_rule_id, $contentType);
    }

    /**
     * Operation deleteSecurityGroupRuleWithHttpInfo
     *
     * Delete rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id (required)
     * @param  string $security_group_rule_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteSecurityGroupRuleWithHttpInfo($zone, $security_group_id, $security_group_rule_id, string $contentType = self::contentTypes['deleteSecurityGroupRule'][0])
    {
        $request = $this->deleteSecurityGroupRuleRequest($zone, $security_group_id, $security_group_rule_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }

    /**
     * Operation deleteSecurityGroupRuleAsync
     *
     * Delete rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id (required)
     * @param  string $security_group_rule_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteSecurityGroupRuleAsync($zone, $security_group_id, $security_group_rule_id, string $contentType = self::contentTypes['deleteSecurityGroupRule'][0])
    {
        return $this->deleteSecurityGroupRuleAsyncWithHttpInfo($zone, $security_group_id, $security_group_rule_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteSecurityGroupRuleAsyncWithHttpInfo
     *
     * Delete rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id (required)
     * @param  string $security_group_rule_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteSecurityGroupRuleAsyncWithHttpInfo($zone, $security_group_id, $security_group_rule_id, string $contentType = self::contentTypes['deleteSecurityGroupRule'][0])
    {
        $returnType = '';
        $request = $this->deleteSecurityGroupRuleRequest($zone, $security_group_id, $security_group_rule_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteSecurityGroupRule'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id (required)
     * @param  string $security_group_rule_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteSecurityGroupRuleRequest($zone, $security_group_id, $security_group_rule_id, string $contentType = self::contentTypes['deleteSecurityGroupRule'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling deleteSecurityGroupRule'
            );
        }

        // verify the required parameter 'security_group_id' is set
        if ($security_group_id === null || (is_array($security_group_id) && count($security_group_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $security_group_id when calling deleteSecurityGroupRule'
            );
        }

        // verify the required parameter 'security_group_rule_id' is set
        if ($security_group_rule_id === null || (is_array($security_group_rule_id) && count($security_group_rule_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $security_group_rule_id when calling deleteSecurityGroupRule'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/security_groups/{security_group_id}/rules/{security_group_rule_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($zone !== null) {
            $resourcePath = str_replace(
                '{' . 'zone' . '}',
                ObjectSerializer::toPathValue($zone),
                $resourcePath
            );
        }
        // path params
        if ($security_group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'security_group_id' . '}',
                ObjectSerializer::toPathValue($security_group_id),
                $resourcePath
            );
        }
        // path params
        if ($security_group_rule_id !== null) {
            $resourcePath = str_replace(
                '{' . 'security_group_rule_id' . '}',
                ObjectSerializer::toPathValue($security_group_rule_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Token');
        if ($apiKey !== null) {
            $headers['X-Auth-Token'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getSecurityGroup
     *
     * Get a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getSecurityGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupResponse
     */
    public function getSecurityGroup($zone, $security_group_id, string $contentType = self::contentTypes['getSecurityGroup'][0])
    {
        list($response) = $this->getSecurityGroupWithHttpInfo($zone, $security_group_id, $contentType);
        return $response;
    }

    /**
     * Operation getSecurityGroupWithHttpInfo
     *
     * Get a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getSecurityGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getSecurityGroupWithHttpInfo($zone, $security_group_id, string $contentType = self::contentTypes['getSecurityGroup'][0])
    {
        $request = $this->getSecurityGroupRequest($zone, $security_group_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getSecurityGroupAsync
     *
     * Get a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getSecurityGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getSecurityGroupAsync($zone, $security_group_id, string $contentType = self::contentTypes['getSecurityGroup'][0])
    {
        return $this->getSecurityGroupAsyncWithHttpInfo($zone, $security_group_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getSecurityGroupAsyncWithHttpInfo
     *
     * Get a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getSecurityGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getSecurityGroupAsyncWithHttpInfo($zone, $security_group_id, string $contentType = self::contentTypes['getSecurityGroup'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupResponse';
        $request = $this->getSecurityGroupRequest($zone, $security_group_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getSecurityGroup'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getSecurityGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getSecurityGroupRequest($zone, $security_group_id, string $contentType = self::contentTypes['getSecurityGroup'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling getSecurityGroup'
            );
        }

        // verify the required parameter 'security_group_id' is set
        if ($security_group_id === null || (is_array($security_group_id) && count($security_group_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $security_group_id when calling getSecurityGroup'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/security_groups/{security_group_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($zone !== null) {
            $resourcePath = str_replace(
                '{' . 'zone' . '}',
                ObjectSerializer::toPathValue($zone),
                $resourcePath
            );
        }
        // path params
        if ($security_group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'security_group_id' . '}',
                ObjectSerializer::toPathValue($security_group_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Token');
        if ($apiKey !== null) {
            $headers['X-Auth-Token'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getSecurityGroupRule
     *
     * Get rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id security_group_id (required)
     * @param  string $security_group_rule_id security_group_rule_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupRuleResponse
     */
    public function getSecurityGroupRule($zone, $security_group_id, $security_group_rule_id, string $contentType = self::contentTypes['getSecurityGroupRule'][0])
    {
        list($response) = $this->getSecurityGroupRuleWithHttpInfo($zone, $security_group_id, $security_group_rule_id, $contentType);
        return $response;
    }

    /**
     * Operation getSecurityGroupRuleWithHttpInfo
     *
     * Get rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id (required)
     * @param  string $security_group_rule_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupRuleResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getSecurityGroupRuleWithHttpInfo($zone, $security_group_id, $security_group_rule_id, string $contentType = self::contentTypes['getSecurityGroupRule'][0])
    {
        $request = $this->getSecurityGroupRuleRequest($zone, $security_group_id, $security_group_rule_id, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupRuleResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupRuleResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupRuleResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupRuleResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupRuleResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getSecurityGroupRuleAsync
     *
     * Get rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id (required)
     * @param  string $security_group_rule_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getSecurityGroupRuleAsync($zone, $security_group_id, $security_group_rule_id, string $contentType = self::contentTypes['getSecurityGroupRule'][0])
    {
        return $this->getSecurityGroupRuleAsyncWithHttpInfo($zone, $security_group_id, $security_group_rule_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getSecurityGroupRuleAsyncWithHttpInfo
     *
     * Get rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id (required)
     * @param  string $security_group_rule_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getSecurityGroupRuleAsyncWithHttpInfo($zone, $security_group_id, $security_group_rule_id, string $contentType = self::contentTypes['getSecurityGroupRule'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1GetSecurityGroupRuleResponse';
        $request = $this->getSecurityGroupRuleRequest($zone, $security_group_id, $security_group_rule_id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getSecurityGroupRule'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id (required)
     * @param  string $security_group_rule_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getSecurityGroupRuleRequest($zone, $security_group_id, $security_group_rule_id, string $contentType = self::contentTypes['getSecurityGroupRule'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling getSecurityGroupRule'
            );
        }

        // verify the required parameter 'security_group_id' is set
        if ($security_group_id === null || (is_array($security_group_id) && count($security_group_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $security_group_id when calling getSecurityGroupRule'
            );
        }

        // verify the required parameter 'security_group_rule_id' is set
        if ($security_group_rule_id === null || (is_array($security_group_rule_id) && count($security_group_rule_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $security_group_rule_id when calling getSecurityGroupRule'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/security_groups/{security_group_id}/rules/{security_group_rule_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($zone !== null) {
            $resourcePath = str_replace(
                '{' . 'zone' . '}',
                ObjectSerializer::toPathValue($zone),
                $resourcePath
            );
        }
        // path params
        if ($security_group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'security_group_id' . '}',
                ObjectSerializer::toPathValue($security_group_id),
                $resourcePath
            );
        }
        // path params
        if ($security_group_rule_id !== null) {
            $resourcePath = str_replace(
                '{' . 'security_group_rule_id' . '}',
                ObjectSerializer::toPathValue($security_group_rule_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Token');
        if ($apiKey !== null) {
            $headers['X-Auth-Token'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation listDefaultSecurityGroupRules
     *
     * Get default rules
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listDefaultSecurityGroupRules'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse
     */
    public function listDefaultSecurityGroupRules($zone, string $contentType = self::contentTypes['listDefaultSecurityGroupRules'][0])
    {
        list($response) = $this->listDefaultSecurityGroupRulesWithHttpInfo($zone, $contentType);
        return $response;
    }

    /**
     * Operation listDefaultSecurityGroupRulesWithHttpInfo
     *
     * Get default rules
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listDefaultSecurityGroupRules'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function listDefaultSecurityGroupRulesWithHttpInfo($zone, string $contentType = self::contentTypes['listDefaultSecurityGroupRules'][0])
    {
        $request = $this->listDefaultSecurityGroupRulesRequest($zone, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation listDefaultSecurityGroupRulesAsync
     *
     * Get default rules
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listDefaultSecurityGroupRules'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listDefaultSecurityGroupRulesAsync($zone, string $contentType = self::contentTypes['listDefaultSecurityGroupRules'][0])
    {
        return $this->listDefaultSecurityGroupRulesAsyncWithHttpInfo($zone, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listDefaultSecurityGroupRulesAsyncWithHttpInfo
     *
     * Get default rules
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listDefaultSecurityGroupRules'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listDefaultSecurityGroupRulesAsyncWithHttpInfo($zone, string $contentType = self::contentTypes['listDefaultSecurityGroupRules'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse';
        $request = $this->listDefaultSecurityGroupRulesRequest($zone, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'listDefaultSecurityGroupRules'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listDefaultSecurityGroupRules'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function listDefaultSecurityGroupRulesRequest($zone, string $contentType = self::contentTypes['listDefaultSecurityGroupRules'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling listDefaultSecurityGroupRules'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/security_groups/default/rules';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($zone !== null) {
            $resourcePath = str_replace(
                '{' . 'zone' . '}',
                ObjectSerializer::toPathValue($zone),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Token');
        if ($apiKey !== null) {
            $headers['X-Auth-Token'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation listSecurityGroupRules
     *
     * List rules
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (required)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listSecurityGroupRules'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse
     */
    public function listSecurityGroupRules($zone, $security_group_id, $per_page = null, $page = 1, string $contentType = self::contentTypes['listSecurityGroupRules'][0])
    {
        list($response) = $this->listSecurityGroupRulesWithHttpInfo($zone, $security_group_id, $per_page, $page, $contentType);
        return $response;
    }

    /**
     * Operation listSecurityGroupRulesWithHttpInfo
     *
     * List rules
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (required)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listSecurityGroupRules'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function listSecurityGroupRulesWithHttpInfo($zone, $security_group_id, $per_page = null, $page = 1, string $contentType = self::contentTypes['listSecurityGroupRules'][0])
    {
        $request = $this->listSecurityGroupRulesRequest($zone, $security_group_id, $per_page, $page, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation listSecurityGroupRulesAsync
     *
     * List rules
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (required)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listSecurityGroupRules'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listSecurityGroupRulesAsync($zone, $security_group_id, $per_page = null, $page = 1, string $contentType = self::contentTypes['listSecurityGroupRules'][0])
    {
        return $this->listSecurityGroupRulesAsyncWithHttpInfo($zone, $security_group_id, $per_page, $page, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listSecurityGroupRulesAsyncWithHttpInfo
     *
     * List rules
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (required)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listSecurityGroupRules'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listSecurityGroupRulesAsyncWithHttpInfo($zone, $security_group_id, $per_page = null, $page = 1, string $contentType = self::contentTypes['listSecurityGroupRules'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupRulesResponse';
        $request = $this->listSecurityGroupRulesRequest($zone, $security_group_id, $per_page, $page, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'listSecurityGroupRules'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (required)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listSecurityGroupRules'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function listSecurityGroupRulesRequest($zone, $security_group_id, $per_page = null, $page = 1, string $contentType = self::contentTypes['listSecurityGroupRules'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling listSecurityGroupRules'
            );
        }

        // verify the required parameter 'security_group_id' is set
        if ($security_group_id === null || (is_array($security_group_id) && count($security_group_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $security_group_id when calling listSecurityGroupRules'
            );
        }




        $resourcePath = '/instance/v1/zones/{zone}/security_groups/{security_group_id}/rules';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $per_page,
            'per_page', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page,
            'page', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($zone !== null) {
            $resourcePath = str_replace(
                '{' . 'zone' . '}',
                ObjectSerializer::toPathValue($zone),
                $resourcePath
            );
        }
        // path params
        if ($security_group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'security_group_id' . '}',
                ObjectSerializer::toPathValue($security_group_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Token');
        if ($apiKey !== null) {
            $headers['X-Auth-Token'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation listSecurityGroups
     *
     * List security groups
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $name Name of the security group. (optional)
     * @param  string $organization Security group Organization ID. (optional)
     * @param  string $project Security group Project ID. (optional)
     * @param  string $tags List security groups with these exact tags (to filter with several tags, use commas to separate them). (optional)
     * @param  bool $project_default Filter security groups with this value for project_default. (optional)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listSecurityGroups'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupsResponse
     */
    public function listSecurityGroups($zone, $name = null, $organization = null, $project = null, $tags = null, $project_default = null, $per_page = null, $page = 1, string $contentType = self::contentTypes['listSecurityGroups'][0])
    {
        list($response) = $this->listSecurityGroupsWithHttpInfo($zone, $name, $organization, $project, $tags, $project_default, $per_page, $page, $contentType);
        return $response;
    }

    /**
     * Operation listSecurityGroupsWithHttpInfo
     *
     * List security groups
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $name Name of the security group. (optional)
     * @param  string $organization Security group Organization ID. (optional)
     * @param  string $project Security group Project ID. (optional)
     * @param  string $tags List security groups with these exact tags (to filter with several tags, use commas to separate them). (optional)
     * @param  bool $project_default Filter security groups with this value for project_default. (optional)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listSecurityGroups'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function listSecurityGroupsWithHttpInfo($zone, $name = null, $organization = null, $project = null, $tags = null, $project_default = null, $per_page = null, $page = 1, string $contentType = self::contentTypes['listSecurityGroups'][0])
    {
        $request = $this->listSecurityGroupsRequest($zone, $name, $organization, $project, $tags, $project_default, $per_page, $page, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupsResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation listSecurityGroupsAsync
     *
     * List security groups
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $name Name of the security group. (optional)
     * @param  string $organization Security group Organization ID. (optional)
     * @param  string $project Security group Project ID. (optional)
     * @param  string $tags List security groups with these exact tags (to filter with several tags, use commas to separate them). (optional)
     * @param  bool $project_default Filter security groups with this value for project_default. (optional)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listSecurityGroups'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listSecurityGroupsAsync($zone, $name = null, $organization = null, $project = null, $tags = null, $project_default = null, $per_page = null, $page = 1, string $contentType = self::contentTypes['listSecurityGroups'][0])
    {
        return $this->listSecurityGroupsAsyncWithHttpInfo($zone, $name, $organization, $project, $tags, $project_default, $per_page, $page, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listSecurityGroupsAsyncWithHttpInfo
     *
     * List security groups
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $name Name of the security group. (optional)
     * @param  string $organization Security group Organization ID. (optional)
     * @param  string $project Security group Project ID. (optional)
     * @param  string $tags List security groups with these exact tags (to filter with several tags, use commas to separate them). (optional)
     * @param  bool $project_default Filter security groups with this value for project_default. (optional)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listSecurityGroups'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listSecurityGroupsAsyncWithHttpInfo($zone, $name = null, $organization = null, $project = null, $tags = null, $project_default = null, $per_page = null, $page = 1, string $contentType = self::contentTypes['listSecurityGroups'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1ListSecurityGroupsResponse';
        $request = $this->listSecurityGroupsRequest($zone, $name, $organization, $project, $tags, $project_default, $per_page, $page, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'listSecurityGroups'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $name Name of the security group. (optional)
     * @param  string $organization Security group Organization ID. (optional)
     * @param  string $project Security group Project ID. (optional)
     * @param  string $tags List security groups with these exact tags (to filter with several tags, use commas to separate them). (optional)
     * @param  bool $project_default Filter security groups with this value for project_default. (optional)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listSecurityGroups'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function listSecurityGroupsRequest($zone, $name = null, $organization = null, $project = null, $tags = null, $project_default = null, $per_page = null, $page = 1, string $contentType = self::contentTypes['listSecurityGroups'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling listSecurityGroups'
            );
        }









        $resourcePath = '/instance/v1/zones/{zone}/security_groups';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $name,
            'name', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $organization,
            'organization', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $project,
            'project', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $tags,
            'tags', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $project_default,
            'project_default', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $per_page,
            'per_page', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page,
            'page', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($zone !== null) {
            $resourcePath = str_replace(
                '{' . 'zone' . '}',
                ObjectSerializer::toPathValue($zone),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Token');
        if ($apiKey !== null) {
            $headers['X-Auth-Token'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation setSecurityGroup
     *
     * Update a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $id UUID of the security group. (required)
     * @param  \OpenAPI\Client\Model\SetSecurityGroupRequest $set_security_group_request set_security_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setSecurityGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupResponse
     */
    public function setSecurityGroup($zone, $id, $set_security_group_request, string $contentType = self::contentTypes['setSecurityGroup'][0])
    {
        list($response) = $this->setSecurityGroupWithHttpInfo($zone, $id, $set_security_group_request, $contentType);
        return $response;
    }

    /**
     * Operation setSecurityGroupWithHttpInfo
     *
     * Update a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $id UUID of the security group. (required)
     * @param  \OpenAPI\Client\Model\SetSecurityGroupRequest $set_security_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setSecurityGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function setSecurityGroupWithHttpInfo($zone, $id, $set_security_group_request, string $contentType = self::contentTypes['setSecurityGroup'][0])
    {
        $request = $this->setSecurityGroupRequest($zone, $id, $set_security_group_request, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation setSecurityGroupAsync
     *
     * Update a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $id UUID of the security group. (required)
     * @param  \OpenAPI\Client\Model\SetSecurityGroupRequest $set_security_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setSecurityGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setSecurityGroupAsync($zone, $id, $set_security_group_request, string $contentType = self::contentTypes['setSecurityGroup'][0])
    {
        return $this->setSecurityGroupAsyncWithHttpInfo($zone, $id, $set_security_group_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation setSecurityGroupAsyncWithHttpInfo
     *
     * Update a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $id UUID of the security group. (required)
     * @param  \OpenAPI\Client\Model\SetSecurityGroupRequest $set_security_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setSecurityGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setSecurityGroupAsyncWithHttpInfo($zone, $id, $set_security_group_request, string $contentType = self::contentTypes['setSecurityGroup'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupResponse';
        $request = $this->setSecurityGroupRequest($zone, $id, $set_security_group_request, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'setSecurityGroup'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $id UUID of the security group. (required)
     * @param  \OpenAPI\Client\Model\SetSecurityGroupRequest $set_security_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setSecurityGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function setSecurityGroupRequest($zone, $id, $set_security_group_request, string $contentType = self::contentTypes['setSecurityGroup'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling setSecurityGroup'
            );
        }

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling setSecurityGroup'
            );
        }

        // verify the required parameter 'set_security_group_request' is set
        if ($set_security_group_request === null || (is_array($set_security_group_request) && count($set_security_group_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $set_security_group_request when calling setSecurityGroup'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/security_groups/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($zone !== null) {
            $resourcePath = str_replace(
                '{' . 'zone' . '}',
                ObjectSerializer::toPathValue($zone),
                $resourcePath
            );
        }
        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($set_security_group_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($set_security_group_request));
            } else {
                $httpBody = $set_security_group_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Token');
        if ($apiKey !== null) {
            $headers['X-Auth-Token'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation setSecurityGroupRule
     *
     * Set security group rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id security_group_id (required)
     * @param  string $security_group_rule_id security_group_rule_id (required)
     * @param  \OpenAPI\Client\Model\SetSecurityGroupRuleRequest $set_security_group_rule_request set_security_group_rule_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRuleResponse
     */
    public function setSecurityGroupRule($zone, $security_group_id, $security_group_rule_id, $set_security_group_rule_request, string $contentType = self::contentTypes['setSecurityGroupRule'][0])
    {
        list($response) = $this->setSecurityGroupRuleWithHttpInfo($zone, $security_group_id, $security_group_rule_id, $set_security_group_rule_request, $contentType);
        return $response;
    }

    /**
     * Operation setSecurityGroupRuleWithHttpInfo
     *
     * Set security group rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id (required)
     * @param  string $security_group_rule_id (required)
     * @param  \OpenAPI\Client\Model\SetSecurityGroupRuleRequest $set_security_group_rule_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRuleResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function setSecurityGroupRuleWithHttpInfo($zone, $security_group_id, $security_group_rule_id, $set_security_group_rule_request, string $contentType = self::contentTypes['setSecurityGroupRule'][0])
    {
        $request = $this->setSecurityGroupRuleRequest($zone, $security_group_id, $security_group_rule_id, $set_security_group_rule_request, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRuleResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRuleResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRuleResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRuleResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRuleResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation setSecurityGroupRuleAsync
     *
     * Set security group rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id (required)
     * @param  string $security_group_rule_id (required)
     * @param  \OpenAPI\Client\Model\SetSecurityGroupRuleRequest $set_security_group_rule_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setSecurityGroupRuleAsync($zone, $security_group_id, $security_group_rule_id, $set_security_group_rule_request, string $contentType = self::contentTypes['setSecurityGroupRule'][0])
    {
        return $this->setSecurityGroupRuleAsyncWithHttpInfo($zone, $security_group_id, $security_group_rule_id, $set_security_group_rule_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation setSecurityGroupRuleAsyncWithHttpInfo
     *
     * Set security group rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id (required)
     * @param  string $security_group_rule_id (required)
     * @param  \OpenAPI\Client\Model\SetSecurityGroupRuleRequest $set_security_group_rule_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setSecurityGroupRuleAsyncWithHttpInfo($zone, $security_group_id, $security_group_rule_id, $set_security_group_rule_request, string $contentType = self::contentTypes['setSecurityGroupRule'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRuleResponse';
        $request = $this->setSecurityGroupRuleRequest($zone, $security_group_id, $security_group_rule_id, $set_security_group_rule_request, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'setSecurityGroupRule'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id (required)
     * @param  string $security_group_rule_id (required)
     * @param  \OpenAPI\Client\Model\SetSecurityGroupRuleRequest $set_security_group_rule_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function setSecurityGroupRuleRequest($zone, $security_group_id, $security_group_rule_id, $set_security_group_rule_request, string $contentType = self::contentTypes['setSecurityGroupRule'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling setSecurityGroupRule'
            );
        }

        // verify the required parameter 'security_group_id' is set
        if ($security_group_id === null || (is_array($security_group_id) && count($security_group_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $security_group_id when calling setSecurityGroupRule'
            );
        }

        // verify the required parameter 'security_group_rule_id' is set
        if ($security_group_rule_id === null || (is_array($security_group_rule_id) && count($security_group_rule_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $security_group_rule_id when calling setSecurityGroupRule'
            );
        }

        // verify the required parameter 'set_security_group_rule_request' is set
        if ($set_security_group_rule_request === null || (is_array($set_security_group_rule_request) && count($set_security_group_rule_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $set_security_group_rule_request when calling setSecurityGroupRule'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/security_groups/{security_group_id}/rules/{security_group_rule_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($zone !== null) {
            $resourcePath = str_replace(
                '{' . 'zone' . '}',
                ObjectSerializer::toPathValue($zone),
                $resourcePath
            );
        }
        // path params
        if ($security_group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'security_group_id' . '}',
                ObjectSerializer::toPathValue($security_group_id),
                $resourcePath
            );
        }
        // path params
        if ($security_group_rule_id !== null) {
            $resourcePath = str_replace(
                '{' . 'security_group_rule_id' . '}',
                ObjectSerializer::toPathValue($security_group_rule_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($set_security_group_rule_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($set_security_group_rule_request));
            } else {
                $httpBody = $set_security_group_rule_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Token');
        if ($apiKey !== null) {
            $headers['X-Auth-Token'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation setSecurityGroupRules
     *
     * Update all the rules of a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group to update the rules on. (required)
     * @param  \OpenAPI\Client\Model\SetSecurityGroupRulesRequest $set_security_group_rules_request set_security_group_rules_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setSecurityGroupRules'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRulesResponse
     */
    public function setSecurityGroupRules($zone, $security_group_id, $set_security_group_rules_request, string $contentType = self::contentTypes['setSecurityGroupRules'][0])
    {
        list($response) = $this->setSecurityGroupRulesWithHttpInfo($zone, $security_group_id, $set_security_group_rules_request, $contentType);
        return $response;
    }

    /**
     * Operation setSecurityGroupRulesWithHttpInfo
     *
     * Update all the rules of a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group to update the rules on. (required)
     * @param  \OpenAPI\Client\Model\SetSecurityGroupRulesRequest $set_security_group_rules_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setSecurityGroupRules'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRulesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function setSecurityGroupRulesWithHttpInfo($zone, $security_group_id, $set_security_group_rules_request, string $contentType = self::contentTypes['setSecurityGroupRules'][0])
    {
        $request = $this->setSecurityGroupRulesRequest($zone, $security_group_id, $set_security_group_rules_request, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRulesResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRulesResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRulesResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRulesResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRulesResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation setSecurityGroupRulesAsync
     *
     * Update all the rules of a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group to update the rules on. (required)
     * @param  \OpenAPI\Client\Model\SetSecurityGroupRulesRequest $set_security_group_rules_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setSecurityGroupRules'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setSecurityGroupRulesAsync($zone, $security_group_id, $set_security_group_rules_request, string $contentType = self::contentTypes['setSecurityGroupRules'][0])
    {
        return $this->setSecurityGroupRulesAsyncWithHttpInfo($zone, $security_group_id, $set_security_group_rules_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation setSecurityGroupRulesAsyncWithHttpInfo
     *
     * Update all the rules of a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group to update the rules on. (required)
     * @param  \OpenAPI\Client\Model\SetSecurityGroupRulesRequest $set_security_group_rules_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setSecurityGroupRules'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setSecurityGroupRulesAsyncWithHttpInfo($zone, $security_group_id, $set_security_group_rules_request, string $contentType = self::contentTypes['setSecurityGroupRules'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1SetSecurityGroupRulesResponse';
        $request = $this->setSecurityGroupRulesRequest($zone, $security_group_id, $set_security_group_rules_request, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'setSecurityGroupRules'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group to update the rules on. (required)
     * @param  \OpenAPI\Client\Model\SetSecurityGroupRulesRequest $set_security_group_rules_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setSecurityGroupRules'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function setSecurityGroupRulesRequest($zone, $security_group_id, $set_security_group_rules_request, string $contentType = self::contentTypes['setSecurityGroupRules'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling setSecurityGroupRules'
            );
        }

        // verify the required parameter 'security_group_id' is set
        if ($security_group_id === null || (is_array($security_group_id) && count($security_group_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $security_group_id when calling setSecurityGroupRules'
            );
        }

        // verify the required parameter 'set_security_group_rules_request' is set
        if ($set_security_group_rules_request === null || (is_array($set_security_group_rules_request) && count($set_security_group_rules_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $set_security_group_rules_request when calling setSecurityGroupRules'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/security_groups/{security_group_id}/rules';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($zone !== null) {
            $resourcePath = str_replace(
                '{' . 'zone' . '}',
                ObjectSerializer::toPathValue($zone),
                $resourcePath
            );
        }
        // path params
        if ($security_group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'security_group_id' . '}',
                ObjectSerializer::toPathValue($security_group_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($set_security_group_rules_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($set_security_group_rules_request));
            } else {
                $httpBody = $set_security_group_rules_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Token');
        if ($apiKey !== null) {
            $headers['X-Auth-Token'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation updateSecurityGroup
     *
     * Update a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (UUID format) (required)
     * @param  \OpenAPI\Client\Model\UpdateSecurityGroupRequest $update_security_group_request update_security_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateSecurityGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupResponse
     */
    public function updateSecurityGroup($zone, $security_group_id, $update_security_group_request, string $contentType = self::contentTypes['updateSecurityGroup'][0])
    {
        list($response) = $this->updateSecurityGroupWithHttpInfo($zone, $security_group_id, $update_security_group_request, $contentType);
        return $response;
    }

    /**
     * Operation updateSecurityGroupWithHttpInfo
     *
     * Update a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (UUID format) (required)
     * @param  \OpenAPI\Client\Model\UpdateSecurityGroupRequest $update_security_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateSecurityGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateSecurityGroupWithHttpInfo($zone, $security_group_id, $update_security_group_request, string $contentType = self::contentTypes['updateSecurityGroup'][0])
    {
        $request = $this->updateSecurityGroupRequest($zone, $security_group_id, $update_security_group_request, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updateSecurityGroupAsync
     *
     * Update a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (UUID format) (required)
     * @param  \OpenAPI\Client\Model\UpdateSecurityGroupRequest $update_security_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateSecurityGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateSecurityGroupAsync($zone, $security_group_id, $update_security_group_request, string $contentType = self::contentTypes['updateSecurityGroup'][0])
    {
        return $this->updateSecurityGroupAsyncWithHttpInfo($zone, $security_group_id, $update_security_group_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateSecurityGroupAsyncWithHttpInfo
     *
     * Update a security group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (UUID format) (required)
     * @param  \OpenAPI\Client\Model\UpdateSecurityGroupRequest $update_security_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateSecurityGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateSecurityGroupAsyncWithHttpInfo($zone, $security_group_id, $update_security_group_request, string $contentType = self::contentTypes['updateSecurityGroup'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupResponse';
        $request = $this->updateSecurityGroupRequest($zone, $security_group_id, $update_security_group_request, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'updateSecurityGroup'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (UUID format) (required)
     * @param  \OpenAPI\Client\Model\UpdateSecurityGroupRequest $update_security_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateSecurityGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateSecurityGroupRequest($zone, $security_group_id, $update_security_group_request, string $contentType = self::contentTypes['updateSecurityGroup'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling updateSecurityGroup'
            );
        }

        // verify the required parameter 'security_group_id' is set
        if ($security_group_id === null || (is_array($security_group_id) && count($security_group_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $security_group_id when calling updateSecurityGroup'
            );
        }

        // verify the required parameter 'update_security_group_request' is set
        if ($update_security_group_request === null || (is_array($update_security_group_request) && count($update_security_group_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $update_security_group_request when calling updateSecurityGroup'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/security_groups/{security_group_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($zone !== null) {
            $resourcePath = str_replace(
                '{' . 'zone' . '}',
                ObjectSerializer::toPathValue($zone),
                $resourcePath
            );
        }
        // path params
        if ($security_group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'security_group_id' . '}',
                ObjectSerializer::toPathValue($security_group_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($update_security_group_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($update_security_group_request));
            } else {
                $httpBody = $update_security_group_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Token');
        if ($apiKey !== null) {
            $headers['X-Auth-Token'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PATCH',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation updateSecurityGroupRule
     *
     * Update security group rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (UUID format) (required)
     * @param  string $security_group_rule_id UUID of the rule. (UUID format) (required)
     * @param  \OpenAPI\Client\Model\UpdateSecurityGroupRuleRequest $update_security_group_rule_request update_security_group_rule_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupRuleResponse
     */
    public function updateSecurityGroupRule($zone, $security_group_id, $security_group_rule_id, $update_security_group_rule_request, string $contentType = self::contentTypes['updateSecurityGroupRule'][0])
    {
        list($response) = $this->updateSecurityGroupRuleWithHttpInfo($zone, $security_group_id, $security_group_rule_id, $update_security_group_rule_request, $contentType);
        return $response;
    }

    /**
     * Operation updateSecurityGroupRuleWithHttpInfo
     *
     * Update security group rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (UUID format) (required)
     * @param  string $security_group_rule_id UUID of the rule. (UUID format) (required)
     * @param  \OpenAPI\Client\Model\UpdateSecurityGroupRuleRequest $update_security_group_rule_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupRuleResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateSecurityGroupRuleWithHttpInfo($zone, $security_group_id, $security_group_rule_id, $update_security_group_rule_request, string $contentType = self::contentTypes['updateSecurityGroupRule'][0])
    {
        $request = $this->updateSecurityGroupRuleRequest($zone, $security_group_id, $security_group_rule_id, $update_security_group_rule_request, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupRuleResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupRuleResponse' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupRuleResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupRuleResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupRuleResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updateSecurityGroupRuleAsync
     *
     * Update security group rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (UUID format) (required)
     * @param  string $security_group_rule_id UUID of the rule. (UUID format) (required)
     * @param  \OpenAPI\Client\Model\UpdateSecurityGroupRuleRequest $update_security_group_rule_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateSecurityGroupRuleAsync($zone, $security_group_id, $security_group_rule_id, $update_security_group_rule_request, string $contentType = self::contentTypes['updateSecurityGroupRule'][0])
    {
        return $this->updateSecurityGroupRuleAsyncWithHttpInfo($zone, $security_group_id, $security_group_rule_id, $update_security_group_rule_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateSecurityGroupRuleAsyncWithHttpInfo
     *
     * Update security group rule
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (UUID format) (required)
     * @param  string $security_group_rule_id UUID of the rule. (UUID format) (required)
     * @param  \OpenAPI\Client\Model\UpdateSecurityGroupRuleRequest $update_security_group_rule_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateSecurityGroupRuleAsyncWithHttpInfo($zone, $security_group_id, $security_group_rule_id, $update_security_group_rule_request, string $contentType = self::contentTypes['updateSecurityGroupRule'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1UpdateSecurityGroupRuleResponse';
        $request = $this->updateSecurityGroupRuleRequest($zone, $security_group_id, $security_group_rule_id, $update_security_group_rule_request, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'updateSecurityGroupRule'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $security_group_id UUID of the security group. (UUID format) (required)
     * @param  string $security_group_rule_id UUID of the rule. (UUID format) (required)
     * @param  \OpenAPI\Client\Model\UpdateSecurityGroupRuleRequest $update_security_group_rule_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateSecurityGroupRule'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateSecurityGroupRuleRequest($zone, $security_group_id, $security_group_rule_id, $update_security_group_rule_request, string $contentType = self::contentTypes['updateSecurityGroupRule'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling updateSecurityGroupRule'
            );
        }

        // verify the required parameter 'security_group_id' is set
        if ($security_group_id === null || (is_array($security_group_id) && count($security_group_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $security_group_id when calling updateSecurityGroupRule'
            );
        }

        // verify the required parameter 'security_group_rule_id' is set
        if ($security_group_rule_id === null || (is_array($security_group_rule_id) && count($security_group_rule_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $security_group_rule_id when calling updateSecurityGroupRule'
            );
        }

        // verify the required parameter 'update_security_group_rule_request' is set
        if ($update_security_group_rule_request === null || (is_array($update_security_group_rule_request) && count($update_security_group_rule_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $update_security_group_rule_request when calling updateSecurityGroupRule'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/security_groups/{security_group_id}/rules/{security_group_rule_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($zone !== null) {
            $resourcePath = str_replace(
                '{' . 'zone' . '}',
                ObjectSerializer::toPathValue($zone),
                $resourcePath
            );
        }
        // path params
        if ($security_group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'security_group_id' . '}',
                ObjectSerializer::toPathValue($security_group_id),
                $resourcePath
            );
        }
        // path params
        if ($security_group_rule_id !== null) {
            $resourcePath = str_replace(
                '{' . 'security_group_rule_id' . '}',
                ObjectSerializer::toPathValue($security_group_rule_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($update_security_group_rule_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($update_security_group_rule_request));
            } else {
                $httpBody = $update_security_group_rule_request;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Auth-Token');
        if ($apiKey !== null) {
            $headers['X-Auth-Token'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PATCH',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
