<?php
/**
 * PlacementGroupsApi
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
 * PlacementGroupsApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class PlacementGroupsApi
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
        'createPlacementGroup' => [
            'application/json',
        ],
        'deletePlacementGroup' => [
            'application/json',
        ],
        'getPlacementGroup' => [
            'application/json',
        ],
        'getPlacementGroupServers' => [
            'application/json',
        ],
        'listPlacementGroups' => [
            'application/json',
        ],
        'setPlacementGroup' => [
            'application/json',
        ],
        'setPlacementGroupServers' => [
            'application/json',
        ],
        'updatePlacementGroup' => [
            'application/json',
        ],
        'updatePlacementGroupServers' => [
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
     * Operation createPlacementGroup
     *
     * Create a placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  \OpenAPI\Client\Model\CreatePlacementGroupRequest $create_placement_group_request create_placement_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createPlacementGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1CreatePlacementGroupResponse
     */
    public function createPlacementGroup($zone, $create_placement_group_request, string $contentType = self::contentTypes['createPlacementGroup'][0])
    {
        list($response) = $this->createPlacementGroupWithHttpInfo($zone, $create_placement_group_request, $contentType);
        return $response;
    }

    /**
     * Operation createPlacementGroupWithHttpInfo
     *
     * Create a placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  \OpenAPI\Client\Model\CreatePlacementGroupRequest $create_placement_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createPlacementGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1CreatePlacementGroupResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createPlacementGroupWithHttpInfo($zone, $create_placement_group_request, string $contentType = self::contentTypes['createPlacementGroup'][0])
    {
        $request = $this->createPlacementGroupRequest($zone, $create_placement_group_request, $contentType);

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
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1CreatePlacementGroupResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1CreatePlacementGroupResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1CreatePlacementGroupResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1CreatePlacementGroupResponse';
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
                        '\OpenAPI\Client\Model\ScalewayInstanceV1CreatePlacementGroupResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createPlacementGroupAsync
     *
     * Create a placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  \OpenAPI\Client\Model\CreatePlacementGroupRequest $create_placement_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createPlacementGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createPlacementGroupAsync($zone, $create_placement_group_request, string $contentType = self::contentTypes['createPlacementGroup'][0])
    {
        return $this->createPlacementGroupAsyncWithHttpInfo($zone, $create_placement_group_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createPlacementGroupAsyncWithHttpInfo
     *
     * Create a placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  \OpenAPI\Client\Model\CreatePlacementGroupRequest $create_placement_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createPlacementGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createPlacementGroupAsyncWithHttpInfo($zone, $create_placement_group_request, string $contentType = self::contentTypes['createPlacementGroup'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1CreatePlacementGroupResponse';
        $request = $this->createPlacementGroupRequest($zone, $create_placement_group_request, $contentType);

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
     * Create request for operation 'createPlacementGroup'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  \OpenAPI\Client\Model\CreatePlacementGroupRequest $create_placement_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createPlacementGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createPlacementGroupRequest($zone, $create_placement_group_request, string $contentType = self::contentTypes['createPlacementGroup'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling createPlacementGroup'
            );
        }

        // verify the required parameter 'create_placement_group_request' is set
        if ($create_placement_group_request === null || (is_array($create_placement_group_request) && count($create_placement_group_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $create_placement_group_request when calling createPlacementGroup'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/placement_groups';
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
        if (isset($create_placement_group_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($create_placement_group_request));
            } else {
                $httpBody = $create_placement_group_request;
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
     * Operation deletePlacementGroup
     *
     * Delete the specified placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to delete. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deletePlacementGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deletePlacementGroup($zone, $placement_group_id, string $contentType = self::contentTypes['deletePlacementGroup'][0])
    {
        $this->deletePlacementGroupWithHttpInfo($zone, $placement_group_id, $contentType);
    }

    /**
     * Operation deletePlacementGroupWithHttpInfo
     *
     * Delete the specified placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to delete. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deletePlacementGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deletePlacementGroupWithHttpInfo($zone, $placement_group_id, string $contentType = self::contentTypes['deletePlacementGroup'][0])
    {
        $request = $this->deletePlacementGroupRequest($zone, $placement_group_id, $contentType);

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
     * Operation deletePlacementGroupAsync
     *
     * Delete the specified placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to delete. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deletePlacementGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deletePlacementGroupAsync($zone, $placement_group_id, string $contentType = self::contentTypes['deletePlacementGroup'][0])
    {
        return $this->deletePlacementGroupAsyncWithHttpInfo($zone, $placement_group_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deletePlacementGroupAsyncWithHttpInfo
     *
     * Delete the specified placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to delete. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deletePlacementGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deletePlacementGroupAsyncWithHttpInfo($zone, $placement_group_id, string $contentType = self::contentTypes['deletePlacementGroup'][0])
    {
        $returnType = '';
        $request = $this->deletePlacementGroupRequest($zone, $placement_group_id, $contentType);

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
     * Create request for operation 'deletePlacementGroup'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to delete. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deletePlacementGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deletePlacementGroupRequest($zone, $placement_group_id, string $contentType = self::contentTypes['deletePlacementGroup'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling deletePlacementGroup'
            );
        }

        // verify the required parameter 'placement_group_id' is set
        if ($placement_group_id === null || (is_array($placement_group_id) && count($placement_group_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $placement_group_id when calling deletePlacementGroup'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/placement_groups/{placement_group_id}';
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
        if ($placement_group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'placement_group_id' . '}',
                ObjectSerializer::toPathValue($placement_group_id),
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
     * Operation getPlacementGroup
     *
     * Get a placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPlacementGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupResponse
     */
    public function getPlacementGroup($zone, $placement_group_id, string $contentType = self::contentTypes['getPlacementGroup'][0])
    {
        list($response) = $this->getPlacementGroupWithHttpInfo($zone, $placement_group_id, $contentType);
        return $response;
    }

    /**
     * Operation getPlacementGroupWithHttpInfo
     *
     * Get a placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPlacementGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getPlacementGroupWithHttpInfo($zone, $placement_group_id, string $contentType = self::contentTypes['getPlacementGroup'][0])
    {
        $request = $this->getPlacementGroupRequest($zone, $placement_group_id, $contentType);

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
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupResponse';
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
                        '\OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getPlacementGroupAsync
     *
     * Get a placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPlacementGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getPlacementGroupAsync($zone, $placement_group_id, string $contentType = self::contentTypes['getPlacementGroup'][0])
    {
        return $this->getPlacementGroupAsyncWithHttpInfo($zone, $placement_group_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPlacementGroupAsyncWithHttpInfo
     *
     * Get a placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPlacementGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getPlacementGroupAsyncWithHttpInfo($zone, $placement_group_id, string $contentType = self::contentTypes['getPlacementGroup'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupResponse';
        $request = $this->getPlacementGroupRequest($zone, $placement_group_id, $contentType);

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
     * Create request for operation 'getPlacementGroup'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPlacementGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getPlacementGroupRequest($zone, $placement_group_id, string $contentType = self::contentTypes['getPlacementGroup'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling getPlacementGroup'
            );
        }

        // verify the required parameter 'placement_group_id' is set
        if ($placement_group_id === null || (is_array($placement_group_id) && count($placement_group_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $placement_group_id when calling getPlacementGroup'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/placement_groups/{placement_group_id}';
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
        if ($placement_group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'placement_group_id' . '}',
                ObjectSerializer::toPathValue($placement_group_id),
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
     * Operation getPlacementGroupServers
     *
     * Get placement group servers
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPlacementGroupServers'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupServersResponse
     */
    public function getPlacementGroupServers($zone, $placement_group_id, string $contentType = self::contentTypes['getPlacementGroupServers'][0])
    {
        list($response) = $this->getPlacementGroupServersWithHttpInfo($zone, $placement_group_id, $contentType);
        return $response;
    }

    /**
     * Operation getPlacementGroupServersWithHttpInfo
     *
     * Get placement group servers
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPlacementGroupServers'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupServersResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getPlacementGroupServersWithHttpInfo($zone, $placement_group_id, string $contentType = self::contentTypes['getPlacementGroupServers'][0])
    {
        $request = $this->getPlacementGroupServersRequest($zone, $placement_group_id, $contentType);

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
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupServersResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupServersResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupServersResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupServersResponse';
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
                        '\OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupServersResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getPlacementGroupServersAsync
     *
     * Get placement group servers
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPlacementGroupServers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getPlacementGroupServersAsync($zone, $placement_group_id, string $contentType = self::contentTypes['getPlacementGroupServers'][0])
    {
        return $this->getPlacementGroupServersAsyncWithHttpInfo($zone, $placement_group_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPlacementGroupServersAsyncWithHttpInfo
     *
     * Get placement group servers
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPlacementGroupServers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getPlacementGroupServersAsyncWithHttpInfo($zone, $placement_group_id, string $contentType = self::contentTypes['getPlacementGroupServers'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1GetPlacementGroupServersResponse';
        $request = $this->getPlacementGroupServersRequest($zone, $placement_group_id, $contentType);

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
     * Create request for operation 'getPlacementGroupServers'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPlacementGroupServers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getPlacementGroupServersRequest($zone, $placement_group_id, string $contentType = self::contentTypes['getPlacementGroupServers'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling getPlacementGroupServers'
            );
        }

        // verify the required parameter 'placement_group_id' is set
        if ($placement_group_id === null || (is_array($placement_group_id) && count($placement_group_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $placement_group_id when calling getPlacementGroupServers'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/placement_groups/{placement_group_id}/servers';
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
        if ($placement_group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'placement_group_id' . '}',
                ObjectSerializer::toPathValue($placement_group_id),
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
     * Operation listPlacementGroups
     *
     * List placement groups
     *
     * @param  string $zone The zone you want to target (required)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $organization List only placement groups of this Organization ID. (optional)
     * @param  string $project List only placement groups of this Project ID. (optional)
     * @param  string $tags List placement groups with these exact tags (to filter with several tags, use commas to separate them). (optional)
     * @param  string $name Filter placement groups by name (for eg. \&quot;cluster1\&quot; will return \&quot;cluster100\&quot; and \&quot;cluster1\&quot; but not \&quot;foo\&quot;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listPlacementGroups'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ListPlacementGroupsResponse
     */
    public function listPlacementGroups($zone, $per_page = null, $page = 1, $organization = null, $project = null, $tags = null, $name = null, string $contentType = self::contentTypes['listPlacementGroups'][0])
    {
        list($response) = $this->listPlacementGroupsWithHttpInfo($zone, $per_page, $page, $organization, $project, $tags, $name, $contentType);
        return $response;
    }

    /**
     * Operation listPlacementGroupsWithHttpInfo
     *
     * List placement groups
     *
     * @param  string $zone The zone you want to target (required)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $organization List only placement groups of this Organization ID. (optional)
     * @param  string $project List only placement groups of this Project ID. (optional)
     * @param  string $tags List placement groups with these exact tags (to filter with several tags, use commas to separate them). (optional)
     * @param  string $name Filter placement groups by name (for eg. \&quot;cluster1\&quot; will return \&quot;cluster100\&quot; and \&quot;cluster1\&quot; but not \&quot;foo\&quot;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listPlacementGroups'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1ListPlacementGroupsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function listPlacementGroupsWithHttpInfo($zone, $per_page = null, $page = 1, $organization = null, $project = null, $tags = null, $name = null, string $contentType = self::contentTypes['listPlacementGroups'][0])
    {
        $request = $this->listPlacementGroupsRequest($zone, $per_page, $page, $organization, $project, $tags, $name, $contentType);

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
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1ListPlacementGroupsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1ListPlacementGroupsResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1ListPlacementGroupsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1ListPlacementGroupsResponse';
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
                        '\OpenAPI\Client\Model\ScalewayInstanceV1ListPlacementGroupsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation listPlacementGroupsAsync
     *
     * List placement groups
     *
     * @param  string $zone The zone you want to target (required)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $organization List only placement groups of this Organization ID. (optional)
     * @param  string $project List only placement groups of this Project ID. (optional)
     * @param  string $tags List placement groups with these exact tags (to filter with several tags, use commas to separate them). (optional)
     * @param  string $name Filter placement groups by name (for eg. \&quot;cluster1\&quot; will return \&quot;cluster100\&quot; and \&quot;cluster1\&quot; but not \&quot;foo\&quot;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listPlacementGroups'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listPlacementGroupsAsync($zone, $per_page = null, $page = 1, $organization = null, $project = null, $tags = null, $name = null, string $contentType = self::contentTypes['listPlacementGroups'][0])
    {
        return $this->listPlacementGroupsAsyncWithHttpInfo($zone, $per_page, $page, $organization, $project, $tags, $name, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listPlacementGroupsAsyncWithHttpInfo
     *
     * List placement groups
     *
     * @param  string $zone The zone you want to target (required)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $organization List only placement groups of this Organization ID. (optional)
     * @param  string $project List only placement groups of this Project ID. (optional)
     * @param  string $tags List placement groups with these exact tags (to filter with several tags, use commas to separate them). (optional)
     * @param  string $name Filter placement groups by name (for eg. \&quot;cluster1\&quot; will return \&quot;cluster100\&quot; and \&quot;cluster1\&quot; but not \&quot;foo\&quot;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listPlacementGroups'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listPlacementGroupsAsyncWithHttpInfo($zone, $per_page = null, $page = 1, $organization = null, $project = null, $tags = null, $name = null, string $contentType = self::contentTypes['listPlacementGroups'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1ListPlacementGroupsResponse';
        $request = $this->listPlacementGroupsRequest($zone, $per_page, $page, $organization, $project, $tags, $name, $contentType);

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
     * Create request for operation 'listPlacementGroups'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $organization List only placement groups of this Organization ID. (optional)
     * @param  string $project List only placement groups of this Project ID. (optional)
     * @param  string $tags List placement groups with these exact tags (to filter with several tags, use commas to separate them). (optional)
     * @param  string $name Filter placement groups by name (for eg. \&quot;cluster1\&quot; will return \&quot;cluster100\&quot; and \&quot;cluster1\&quot; but not \&quot;foo\&quot;). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listPlacementGroups'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function listPlacementGroupsRequest($zone, $per_page = null, $page = 1, $organization = null, $project = null, $tags = null, $name = null, string $contentType = self::contentTypes['listPlacementGroups'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling listPlacementGroups'
            );
        }








        $resourcePath = '/instance/v1/zones/{zone}/placement_groups';
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
            $name,
            'name', // param base name
            'string', // openApiType
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
     * Operation setPlacementGroup
     *
     * Set placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id placement_group_id (required)
     * @param  \OpenAPI\Client\Model\SetPlacementGroupRequest $set_placement_group_request set_placement_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setPlacementGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupResponse
     */
    public function setPlacementGroup($zone, $placement_group_id, $set_placement_group_request, string $contentType = self::contentTypes['setPlacementGroup'][0])
    {
        list($response) = $this->setPlacementGroupWithHttpInfo($zone, $placement_group_id, $set_placement_group_request, $contentType);
        return $response;
    }

    /**
     * Operation setPlacementGroupWithHttpInfo
     *
     * Set placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id (required)
     * @param  \OpenAPI\Client\Model\SetPlacementGroupRequest $set_placement_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setPlacementGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function setPlacementGroupWithHttpInfo($zone, $placement_group_id, $set_placement_group_request, string $contentType = self::contentTypes['setPlacementGroup'][0])
    {
        $request = $this->setPlacementGroupRequest($zone, $placement_group_id, $set_placement_group_request, $contentType);

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
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupResponse';
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
                        '\OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation setPlacementGroupAsync
     *
     * Set placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id (required)
     * @param  \OpenAPI\Client\Model\SetPlacementGroupRequest $set_placement_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setPlacementGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setPlacementGroupAsync($zone, $placement_group_id, $set_placement_group_request, string $contentType = self::contentTypes['setPlacementGroup'][0])
    {
        return $this->setPlacementGroupAsyncWithHttpInfo($zone, $placement_group_id, $set_placement_group_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation setPlacementGroupAsyncWithHttpInfo
     *
     * Set placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id (required)
     * @param  \OpenAPI\Client\Model\SetPlacementGroupRequest $set_placement_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setPlacementGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setPlacementGroupAsyncWithHttpInfo($zone, $placement_group_id, $set_placement_group_request, string $contentType = self::contentTypes['setPlacementGroup'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupResponse';
        $request = $this->setPlacementGroupRequest($zone, $placement_group_id, $set_placement_group_request, $contentType);

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
     * Create request for operation 'setPlacementGroup'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id (required)
     * @param  \OpenAPI\Client\Model\SetPlacementGroupRequest $set_placement_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setPlacementGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function setPlacementGroupRequest($zone, $placement_group_id, $set_placement_group_request, string $contentType = self::contentTypes['setPlacementGroup'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling setPlacementGroup'
            );
        }

        // verify the required parameter 'placement_group_id' is set
        if ($placement_group_id === null || (is_array($placement_group_id) && count($placement_group_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $placement_group_id when calling setPlacementGroup'
            );
        }

        // verify the required parameter 'set_placement_group_request' is set
        if ($set_placement_group_request === null || (is_array($set_placement_group_request) && count($set_placement_group_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $set_placement_group_request when calling setPlacementGroup'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/placement_groups/{placement_group_id}';
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
        if ($placement_group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'placement_group_id' . '}',
                ObjectSerializer::toPathValue($placement_group_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($set_placement_group_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($set_placement_group_request));
            } else {
                $httpBody = $set_placement_group_request;
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
     * Operation setPlacementGroupServers
     *
     * Set placement group servers
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to set. (required)
     * @param  \OpenAPI\Client\Model\SetPlacementGroupServersRequest $set_placement_group_servers_request set_placement_group_servers_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setPlacementGroupServers'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupServersResponse
     */
    public function setPlacementGroupServers($zone, $placement_group_id, $set_placement_group_servers_request, string $contentType = self::contentTypes['setPlacementGroupServers'][0])
    {
        list($response) = $this->setPlacementGroupServersWithHttpInfo($zone, $placement_group_id, $set_placement_group_servers_request, $contentType);
        return $response;
    }

    /**
     * Operation setPlacementGroupServersWithHttpInfo
     *
     * Set placement group servers
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to set. (required)
     * @param  \OpenAPI\Client\Model\SetPlacementGroupServersRequest $set_placement_group_servers_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setPlacementGroupServers'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupServersResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function setPlacementGroupServersWithHttpInfo($zone, $placement_group_id, $set_placement_group_servers_request, string $contentType = self::contentTypes['setPlacementGroupServers'][0])
    {
        $request = $this->setPlacementGroupServersRequest($zone, $placement_group_id, $set_placement_group_servers_request, $contentType);

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
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupServersResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupServersResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupServersResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupServersResponse';
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
                        '\OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupServersResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation setPlacementGroupServersAsync
     *
     * Set placement group servers
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to set. (required)
     * @param  \OpenAPI\Client\Model\SetPlacementGroupServersRequest $set_placement_group_servers_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setPlacementGroupServers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setPlacementGroupServersAsync($zone, $placement_group_id, $set_placement_group_servers_request, string $contentType = self::contentTypes['setPlacementGroupServers'][0])
    {
        return $this->setPlacementGroupServersAsyncWithHttpInfo($zone, $placement_group_id, $set_placement_group_servers_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation setPlacementGroupServersAsyncWithHttpInfo
     *
     * Set placement group servers
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to set. (required)
     * @param  \OpenAPI\Client\Model\SetPlacementGroupServersRequest $set_placement_group_servers_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setPlacementGroupServers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setPlacementGroupServersAsyncWithHttpInfo($zone, $placement_group_id, $set_placement_group_servers_request, string $contentType = self::contentTypes['setPlacementGroupServers'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1SetPlacementGroupServersResponse';
        $request = $this->setPlacementGroupServersRequest($zone, $placement_group_id, $set_placement_group_servers_request, $contentType);

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
     * Create request for operation 'setPlacementGroupServers'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to set. (required)
     * @param  \OpenAPI\Client\Model\SetPlacementGroupServersRequest $set_placement_group_servers_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setPlacementGroupServers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function setPlacementGroupServersRequest($zone, $placement_group_id, $set_placement_group_servers_request, string $contentType = self::contentTypes['setPlacementGroupServers'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling setPlacementGroupServers'
            );
        }

        // verify the required parameter 'placement_group_id' is set
        if ($placement_group_id === null || (is_array($placement_group_id) && count($placement_group_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $placement_group_id when calling setPlacementGroupServers'
            );
        }

        // verify the required parameter 'set_placement_group_servers_request' is set
        if ($set_placement_group_servers_request === null || (is_array($set_placement_group_servers_request) && count($set_placement_group_servers_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $set_placement_group_servers_request when calling setPlacementGroupServers'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/placement_groups/{placement_group_id}/servers';
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
        if ($placement_group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'placement_group_id' . '}',
                ObjectSerializer::toPathValue($placement_group_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($set_placement_group_servers_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($set_placement_group_servers_request));
            } else {
                $httpBody = $set_placement_group_servers_request;
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
     * Operation updatePlacementGroup
     *
     * Update a placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group. (required)
     * @param  \OpenAPI\Client\Model\UpdatePlacementGroupRequest $update_placement_group_request update_placement_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updatePlacementGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupResponse
     */
    public function updatePlacementGroup($zone, $placement_group_id, $update_placement_group_request, string $contentType = self::contentTypes['updatePlacementGroup'][0])
    {
        list($response) = $this->updatePlacementGroupWithHttpInfo($zone, $placement_group_id, $update_placement_group_request, $contentType);
        return $response;
    }

    /**
     * Operation updatePlacementGroupWithHttpInfo
     *
     * Update a placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group. (required)
     * @param  \OpenAPI\Client\Model\UpdatePlacementGroupRequest $update_placement_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updatePlacementGroup'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updatePlacementGroupWithHttpInfo($zone, $placement_group_id, $update_placement_group_request, string $contentType = self::contentTypes['updatePlacementGroup'][0])
    {
        $request = $this->updatePlacementGroupRequest($zone, $placement_group_id, $update_placement_group_request, $contentType);

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
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupResponse';
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
                        '\OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updatePlacementGroupAsync
     *
     * Update a placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group. (required)
     * @param  \OpenAPI\Client\Model\UpdatePlacementGroupRequest $update_placement_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updatePlacementGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updatePlacementGroupAsync($zone, $placement_group_id, $update_placement_group_request, string $contentType = self::contentTypes['updatePlacementGroup'][0])
    {
        return $this->updatePlacementGroupAsyncWithHttpInfo($zone, $placement_group_id, $update_placement_group_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updatePlacementGroupAsyncWithHttpInfo
     *
     * Update a placement group
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group. (required)
     * @param  \OpenAPI\Client\Model\UpdatePlacementGroupRequest $update_placement_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updatePlacementGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updatePlacementGroupAsyncWithHttpInfo($zone, $placement_group_id, $update_placement_group_request, string $contentType = self::contentTypes['updatePlacementGroup'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupResponse';
        $request = $this->updatePlacementGroupRequest($zone, $placement_group_id, $update_placement_group_request, $contentType);

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
     * Create request for operation 'updatePlacementGroup'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group. (required)
     * @param  \OpenAPI\Client\Model\UpdatePlacementGroupRequest $update_placement_group_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updatePlacementGroup'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updatePlacementGroupRequest($zone, $placement_group_id, $update_placement_group_request, string $contentType = self::contentTypes['updatePlacementGroup'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling updatePlacementGroup'
            );
        }

        // verify the required parameter 'placement_group_id' is set
        if ($placement_group_id === null || (is_array($placement_group_id) && count($placement_group_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $placement_group_id when calling updatePlacementGroup'
            );
        }

        // verify the required parameter 'update_placement_group_request' is set
        if ($update_placement_group_request === null || (is_array($update_placement_group_request) && count($update_placement_group_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $update_placement_group_request when calling updatePlacementGroup'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/placement_groups/{placement_group_id}';
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
        if ($placement_group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'placement_group_id' . '}',
                ObjectSerializer::toPathValue($placement_group_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($update_placement_group_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($update_placement_group_request));
            } else {
                $httpBody = $update_placement_group_request;
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
     * Operation updatePlacementGroupServers
     *
     * Update placement group servers
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to update. (required)
     * @param  \OpenAPI\Client\Model\SetPlacementGroupServersRequest $set_placement_group_servers_request set_placement_group_servers_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updatePlacementGroupServers'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupServersResponse
     */
    public function updatePlacementGroupServers($zone, $placement_group_id, $set_placement_group_servers_request, string $contentType = self::contentTypes['updatePlacementGroupServers'][0])
    {
        list($response) = $this->updatePlacementGroupServersWithHttpInfo($zone, $placement_group_id, $set_placement_group_servers_request, $contentType);
        return $response;
    }

    /**
     * Operation updatePlacementGroupServersWithHttpInfo
     *
     * Update placement group servers
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to update. (required)
     * @param  \OpenAPI\Client\Model\SetPlacementGroupServersRequest $set_placement_group_servers_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updatePlacementGroupServers'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupServersResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updatePlacementGroupServersWithHttpInfo($zone, $placement_group_id, $set_placement_group_servers_request, string $contentType = self::contentTypes['updatePlacementGroupServers'][0])
    {
        $request = $this->updatePlacementGroupServersRequest($zone, $placement_group_id, $set_placement_group_servers_request, $contentType);

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
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupServersResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupServersResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupServersResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupServersResponse';
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
                        '\OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupServersResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updatePlacementGroupServersAsync
     *
     * Update placement group servers
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to update. (required)
     * @param  \OpenAPI\Client\Model\SetPlacementGroupServersRequest $set_placement_group_servers_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updatePlacementGroupServers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updatePlacementGroupServersAsync($zone, $placement_group_id, $set_placement_group_servers_request, string $contentType = self::contentTypes['updatePlacementGroupServers'][0])
    {
        return $this->updatePlacementGroupServersAsyncWithHttpInfo($zone, $placement_group_id, $set_placement_group_servers_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updatePlacementGroupServersAsyncWithHttpInfo
     *
     * Update placement group servers
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to update. (required)
     * @param  \OpenAPI\Client\Model\SetPlacementGroupServersRequest $set_placement_group_servers_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updatePlacementGroupServers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updatePlacementGroupServersAsyncWithHttpInfo($zone, $placement_group_id, $set_placement_group_servers_request, string $contentType = self::contentTypes['updatePlacementGroupServers'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1UpdatePlacementGroupServersResponse';
        $request = $this->updatePlacementGroupServersRequest($zone, $placement_group_id, $set_placement_group_servers_request, $contentType);

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
     * Create request for operation 'updatePlacementGroupServers'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $placement_group_id UUID of the placement group you want to update. (required)
     * @param  \OpenAPI\Client\Model\SetPlacementGroupServersRequest $set_placement_group_servers_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updatePlacementGroupServers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updatePlacementGroupServersRequest($zone, $placement_group_id, $set_placement_group_servers_request, string $contentType = self::contentTypes['updatePlacementGroupServers'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling updatePlacementGroupServers'
            );
        }

        // verify the required parameter 'placement_group_id' is set
        if ($placement_group_id === null || (is_array($placement_group_id) && count($placement_group_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $placement_group_id when calling updatePlacementGroupServers'
            );
        }

        // verify the required parameter 'set_placement_group_servers_request' is set
        if ($set_placement_group_servers_request === null || (is_array($set_placement_group_servers_request) && count($set_placement_group_servers_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $set_placement_group_servers_request when calling updatePlacementGroupServers'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/placement_groups/{placement_group_id}/servers';
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
        if ($placement_group_id !== null) {
            $resourcePath = str_replace(
                '{' . 'placement_group_id' . '}',
                ObjectSerializer::toPathValue($placement_group_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($set_placement_group_servers_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($set_placement_group_servers_request));
            } else {
                $httpBody = $set_placement_group_servers_request;
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
