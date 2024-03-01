<?php
/**
 * InstancesApi
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
 * InstancesApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class InstancesApi
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
        'createServer' => [
            'application/json',
        ],
        'deleteServer' => [
            'application/json',
        ],
        'getServer' => [
            'application/json',
        ],
        'listServerActions' => [
            'application/json',
        ],
        'listServers' => [
            'application/json',
        ],
        'serverAction' => [
            'application/json',
        ],
        'updateServer' => [
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
     * Operation createServer
     *
     * Create an Instance
     *
     * @param  string $zone The zone you want to target (required)
     * @param  \OpenAPI\Client\Model\CreateServerRequest $create_server_request create_server_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createServer'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1CreateServerResponse
     */
    public function createServer($zone, $create_server_request, string $contentType = self::contentTypes['createServer'][0])
    {
        list($response) = $this->createServerWithHttpInfo($zone, $create_server_request, $contentType);
        return $response;
    }

    /**
     * Operation createServerWithHttpInfo
     *
     * Create an Instance
     *
     * @param  string $zone The zone you want to target (required)
     * @param  \OpenAPI\Client\Model\CreateServerRequest $create_server_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createServer'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1CreateServerResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createServerWithHttpInfo($zone, $create_server_request, string $contentType = self::contentTypes['createServer'][0])
    {
        $request = $this->createServerRequest($zone, $create_server_request, $contentType);

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
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1CreateServerResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1CreateServerResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1CreateServerResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1CreateServerResponse';
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
                        '\OpenAPI\Client\Model\ScalewayInstanceV1CreateServerResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createServerAsync
     *
     * Create an Instance
     *
     * @param  string $zone The zone you want to target (required)
     * @param  \OpenAPI\Client\Model\CreateServerRequest $create_server_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createServer'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createServerAsync($zone, $create_server_request, string $contentType = self::contentTypes['createServer'][0])
    {
        return $this->createServerAsyncWithHttpInfo($zone, $create_server_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createServerAsyncWithHttpInfo
     *
     * Create an Instance
     *
     * @param  string $zone The zone you want to target (required)
     * @param  \OpenAPI\Client\Model\CreateServerRequest $create_server_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createServer'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createServerAsyncWithHttpInfo($zone, $create_server_request, string $contentType = self::contentTypes['createServer'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1CreateServerResponse';
        $request = $this->createServerRequest($zone, $create_server_request, $contentType);

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
     * Create request for operation 'createServer'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  \OpenAPI\Client\Model\CreateServerRequest $create_server_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createServer'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createServerRequest($zone, $create_server_request, string $contentType = self::contentTypes['createServer'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling createServer'
            );
        }

        // verify the required parameter 'create_server_request' is set
        if ($create_server_request === null || (is_array($create_server_request) && count($create_server_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $create_server_request when calling createServer'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/servers';
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
        if (isset($create_server_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($create_server_request));
            } else {
                $httpBody = $create_server_request;
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
     * Operation deleteServer
     *
     * Delete an Instance
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id server_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteServer'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteServer($zone, $server_id, string $contentType = self::contentTypes['deleteServer'][0])
    {
        $this->deleteServerWithHttpInfo($zone, $server_id, $contentType);
    }

    /**
     * Operation deleteServerWithHttpInfo
     *
     * Delete an Instance
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteServer'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteServerWithHttpInfo($zone, $server_id, string $contentType = self::contentTypes['deleteServer'][0])
    {
        $request = $this->deleteServerRequest($zone, $server_id, $contentType);

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
     * Operation deleteServerAsync
     *
     * Delete an Instance
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteServer'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteServerAsync($zone, $server_id, string $contentType = self::contentTypes['deleteServer'][0])
    {
        return $this->deleteServerAsyncWithHttpInfo($zone, $server_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteServerAsyncWithHttpInfo
     *
     * Delete an Instance
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteServer'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteServerAsyncWithHttpInfo($zone, $server_id, string $contentType = self::contentTypes['deleteServer'][0])
    {
        $returnType = '';
        $request = $this->deleteServerRequest($zone, $server_id, $contentType);

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
     * Create request for operation 'deleteServer'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteServer'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteServerRequest($zone, $server_id, string $contentType = self::contentTypes['deleteServer'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling deleteServer'
            );
        }

        // verify the required parameter 'server_id' is set
        if ($server_id === null || (is_array($server_id) && count($server_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $server_id when calling deleteServer'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/servers/{server_id}';
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
        if ($server_id !== null) {
            $resourcePath = str_replace(
                '{' . 'server_id' . '}',
                ObjectSerializer::toPathValue($server_id),
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
     * Operation getServer
     *
     * Get an Instance
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getServer'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1GetServerResponse
     */
    public function getServer($zone, $server_id, string $contentType = self::contentTypes['getServer'][0])
    {
        list($response) = $this->getServerWithHttpInfo($zone, $server_id, $contentType);
        return $response;
    }

    /**
     * Operation getServerWithHttpInfo
     *
     * Get an Instance
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getServer'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1GetServerResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getServerWithHttpInfo($zone, $server_id, string $contentType = self::contentTypes['getServer'][0])
    {
        $request = $this->getServerRequest($zone, $server_id, $contentType);

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
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1GetServerResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1GetServerResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1GetServerResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1GetServerResponse';
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
                        '\OpenAPI\Client\Model\ScalewayInstanceV1GetServerResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getServerAsync
     *
     * Get an Instance
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getServer'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getServerAsync($zone, $server_id, string $contentType = self::contentTypes['getServer'][0])
    {
        return $this->getServerAsyncWithHttpInfo($zone, $server_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getServerAsyncWithHttpInfo
     *
     * Get an Instance
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getServer'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getServerAsyncWithHttpInfo($zone, $server_id, string $contentType = self::contentTypes['getServer'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1GetServerResponse';
        $request = $this->getServerRequest($zone, $server_id, $contentType);

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
     * Create request for operation 'getServer'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance you want to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getServer'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getServerRequest($zone, $server_id, string $contentType = self::contentTypes['getServer'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling getServer'
            );
        }

        // verify the required parameter 'server_id' is set
        if ($server_id === null || (is_array($server_id) && count($server_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $server_id when calling getServer'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/servers/{server_id}';
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
        if ($server_id !== null) {
            $resourcePath = str_replace(
                '{' . 'server_id' . '}',
                ObjectSerializer::toPathValue($server_id),
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
     * Operation listServerActions
     *
     * List Instance actions
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id server_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listServerActions'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ListServerActionsResponse
     */
    public function listServerActions($zone, $server_id, string $contentType = self::contentTypes['listServerActions'][0])
    {
        list($response) = $this->listServerActionsWithHttpInfo($zone, $server_id, $contentType);
        return $response;
    }

    /**
     * Operation listServerActionsWithHttpInfo
     *
     * List Instance actions
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listServerActions'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1ListServerActionsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function listServerActionsWithHttpInfo($zone, $server_id, string $contentType = self::contentTypes['listServerActions'][0])
    {
        $request = $this->listServerActionsRequest($zone, $server_id, $contentType);

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
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1ListServerActionsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1ListServerActionsResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1ListServerActionsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1ListServerActionsResponse';
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
                        '\OpenAPI\Client\Model\ScalewayInstanceV1ListServerActionsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation listServerActionsAsync
     *
     * List Instance actions
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listServerActions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listServerActionsAsync($zone, $server_id, string $contentType = self::contentTypes['listServerActions'][0])
    {
        return $this->listServerActionsAsyncWithHttpInfo($zone, $server_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listServerActionsAsyncWithHttpInfo
     *
     * List Instance actions
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listServerActions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listServerActionsAsyncWithHttpInfo($zone, $server_id, string $contentType = self::contentTypes['listServerActions'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1ListServerActionsResponse';
        $request = $this->listServerActionsRequest($zone, $server_id, $contentType);

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
     * Create request for operation 'listServerActions'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listServerActions'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function listServerActionsRequest($zone, $server_id, string $contentType = self::contentTypes['listServerActions'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling listServerActions'
            );
        }

        // verify the required parameter 'server_id' is set
        if ($server_id === null || (is_array($server_id) && count($server_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $server_id when calling listServerActions'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/servers/{server_id}/action';
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
        if ($server_id !== null) {
            $resourcePath = str_replace(
                '{' . 'server_id' . '}',
                ObjectSerializer::toPathValue($server_id),
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
     * Operation listServers
     *
     * List all Instances
     *
     * @param  string $zone The zone you want to target (required)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $organization List only Instances of this Organization ID. (optional)
     * @param  string $project List only Instances of this Project ID. (optional)
     * @param  string $name Filter Instances by name (eg. \&quot;server1\&quot; will return \&quot;server100\&quot; and \&quot;server1\&quot; but not \&quot;foo\&quot;). (optional)
     * @param  string $private_ip List Instances by private_ip. (IP address) (optional)
     * @param  bool $without_ip List Instances that are not attached to a public IP. (optional)
     * @param  string $commercial_type List Instances of this commercial type. (optional)
     * @param  string $state List Instances in this state. (optional, default to 'running')
     * @param  string $tags List Instances with these exact tags (to filter with several tags, use commas to separate them). (optional)
     * @param  string $private_network List Instances in this Private Network. (optional)
     * @param  string $order Define the order of the returned servers. (optional, default to 'creation_date_desc')
     * @param  string $private_networks List Instances from the given Private Networks (use commas to separate them). (optional)
     * @param  string $private_nic_mac_address List Instances associated with the given private NIC MAC address. (optional)
     * @param  string $servers List Instances from these server ids (use commas to separate them). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listServers'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ListServersResponse
     */
    public function listServers($zone, $per_page = null, $page = 1, $organization = null, $project = null, $name = null, $private_ip = null, $without_ip = null, $commercial_type = null, $state = 'running', $tags = null, $private_network = null, $order = 'creation_date_desc', $private_networks = null, $private_nic_mac_address = null, $servers = null, string $contentType = self::contentTypes['listServers'][0])
    {
        list($response) = $this->listServersWithHttpInfo($zone, $per_page, $page, $organization, $project, $name, $private_ip, $without_ip, $commercial_type, $state, $tags, $private_network, $order, $private_networks, $private_nic_mac_address, $servers, $contentType);
        return $response;
    }

    /**
     * Operation listServersWithHttpInfo
     *
     * List all Instances
     *
     * @param  string $zone The zone you want to target (required)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $organization List only Instances of this Organization ID. (optional)
     * @param  string $project List only Instances of this Project ID. (optional)
     * @param  string $name Filter Instances by name (eg. \&quot;server1\&quot; will return \&quot;server100\&quot; and \&quot;server1\&quot; but not \&quot;foo\&quot;). (optional)
     * @param  string $private_ip List Instances by private_ip. (IP address) (optional)
     * @param  bool $without_ip List Instances that are not attached to a public IP. (optional)
     * @param  string $commercial_type List Instances of this commercial type. (optional)
     * @param  string $state List Instances in this state. (optional, default to 'running')
     * @param  string $tags List Instances with these exact tags (to filter with several tags, use commas to separate them). (optional)
     * @param  string $private_network List Instances in this Private Network. (optional)
     * @param  string $order Define the order of the returned servers. (optional, default to 'creation_date_desc')
     * @param  string $private_networks List Instances from the given Private Networks (use commas to separate them). (optional)
     * @param  string $private_nic_mac_address List Instances associated with the given private NIC MAC address. (optional)
     * @param  string $servers List Instances from these server ids (use commas to separate them). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listServers'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1ListServersResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function listServersWithHttpInfo($zone, $per_page = null, $page = 1, $organization = null, $project = null, $name = null, $private_ip = null, $without_ip = null, $commercial_type = null, $state = 'running', $tags = null, $private_network = null, $order = 'creation_date_desc', $private_networks = null, $private_nic_mac_address = null, $servers = null, string $contentType = self::contentTypes['listServers'][0])
    {
        $request = $this->listServersRequest($zone, $per_page, $page, $organization, $project, $name, $private_ip, $without_ip, $commercial_type, $state, $tags, $private_network, $order, $private_networks, $private_nic_mac_address, $servers, $contentType);

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
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1ListServersResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1ListServersResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1ListServersResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1ListServersResponse';
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
                        '\OpenAPI\Client\Model\ScalewayInstanceV1ListServersResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation listServersAsync
     *
     * List all Instances
     *
     * @param  string $zone The zone you want to target (required)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $organization List only Instances of this Organization ID. (optional)
     * @param  string $project List only Instances of this Project ID. (optional)
     * @param  string $name Filter Instances by name (eg. \&quot;server1\&quot; will return \&quot;server100\&quot; and \&quot;server1\&quot; but not \&quot;foo\&quot;). (optional)
     * @param  string $private_ip List Instances by private_ip. (IP address) (optional)
     * @param  bool $without_ip List Instances that are not attached to a public IP. (optional)
     * @param  string $commercial_type List Instances of this commercial type. (optional)
     * @param  string $state List Instances in this state. (optional, default to 'running')
     * @param  string $tags List Instances with these exact tags (to filter with several tags, use commas to separate them). (optional)
     * @param  string $private_network List Instances in this Private Network. (optional)
     * @param  string $order Define the order of the returned servers. (optional, default to 'creation_date_desc')
     * @param  string $private_networks List Instances from the given Private Networks (use commas to separate them). (optional)
     * @param  string $private_nic_mac_address List Instances associated with the given private NIC MAC address. (optional)
     * @param  string $servers List Instances from these server ids (use commas to separate them). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listServers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listServersAsync($zone, $per_page = null, $page = 1, $organization = null, $project = null, $name = null, $private_ip = null, $without_ip = null, $commercial_type = null, $state = 'running', $tags = null, $private_network = null, $order = 'creation_date_desc', $private_networks = null, $private_nic_mac_address = null, $servers = null, string $contentType = self::contentTypes['listServers'][0])
    {
        return $this->listServersAsyncWithHttpInfo($zone, $per_page, $page, $organization, $project, $name, $private_ip, $without_ip, $commercial_type, $state, $tags, $private_network, $order, $private_networks, $private_nic_mac_address, $servers, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listServersAsyncWithHttpInfo
     *
     * List all Instances
     *
     * @param  string $zone The zone you want to target (required)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $organization List only Instances of this Organization ID. (optional)
     * @param  string $project List only Instances of this Project ID. (optional)
     * @param  string $name Filter Instances by name (eg. \&quot;server1\&quot; will return \&quot;server100\&quot; and \&quot;server1\&quot; but not \&quot;foo\&quot;). (optional)
     * @param  string $private_ip List Instances by private_ip. (IP address) (optional)
     * @param  bool $without_ip List Instances that are not attached to a public IP. (optional)
     * @param  string $commercial_type List Instances of this commercial type. (optional)
     * @param  string $state List Instances in this state. (optional, default to 'running')
     * @param  string $tags List Instances with these exact tags (to filter with several tags, use commas to separate them). (optional)
     * @param  string $private_network List Instances in this Private Network. (optional)
     * @param  string $order Define the order of the returned servers. (optional, default to 'creation_date_desc')
     * @param  string $private_networks List Instances from the given Private Networks (use commas to separate them). (optional)
     * @param  string $private_nic_mac_address List Instances associated with the given private NIC MAC address. (optional)
     * @param  string $servers List Instances from these server ids (use commas to separate them). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listServers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listServersAsyncWithHttpInfo($zone, $per_page = null, $page = 1, $organization = null, $project = null, $name = null, $private_ip = null, $without_ip = null, $commercial_type = null, $state = 'running', $tags = null, $private_network = null, $order = 'creation_date_desc', $private_networks = null, $private_nic_mac_address = null, $servers = null, string $contentType = self::contentTypes['listServers'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1ListServersResponse';
        $request = $this->listServersRequest($zone, $per_page, $page, $organization, $project, $name, $private_ip, $without_ip, $commercial_type, $state, $tags, $private_network, $order, $private_networks, $private_nic_mac_address, $servers, $contentType);

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
     * Create request for operation 'listServers'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  int $per_page A positive integer lower or equal to 100 to select the number of items to return. (optional)
     * @param  int $page A positive integer to choose the page to return. (optional, default to 1)
     * @param  string $organization List only Instances of this Organization ID. (optional)
     * @param  string $project List only Instances of this Project ID. (optional)
     * @param  string $name Filter Instances by name (eg. \&quot;server1\&quot; will return \&quot;server100\&quot; and \&quot;server1\&quot; but not \&quot;foo\&quot;). (optional)
     * @param  string $private_ip List Instances by private_ip. (IP address) (optional)
     * @param  bool $without_ip List Instances that are not attached to a public IP. (optional)
     * @param  string $commercial_type List Instances of this commercial type. (optional)
     * @param  string $state List Instances in this state. (optional, default to 'running')
     * @param  string $tags List Instances with these exact tags (to filter with several tags, use commas to separate them). (optional)
     * @param  string $private_network List Instances in this Private Network. (optional)
     * @param  string $order Define the order of the returned servers. (optional, default to 'creation_date_desc')
     * @param  string $private_networks List Instances from the given Private Networks (use commas to separate them). (optional)
     * @param  string $private_nic_mac_address List Instances associated with the given private NIC MAC address. (optional)
     * @param  string $servers List Instances from these server ids (use commas to separate them). (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listServers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function listServersRequest($zone, $per_page = null, $page = 1, $organization = null, $project = null, $name = null, $private_ip = null, $without_ip = null, $commercial_type = null, $state = 'running', $tags = null, $private_network = null, $order = 'creation_date_desc', $private_networks = null, $private_nic_mac_address = null, $servers = null, string $contentType = self::contentTypes['listServers'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling listServers'
            );
        }

















        $resourcePath = '/instance/v1/zones/{zone}/servers';
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
            $name,
            'name', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $private_ip,
            'private_ip', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $without_ip,
            'without_ip', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $commercial_type,
            'commercial_type', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $state,
            'state', // param base name
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
            $private_network,
            'private_network', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $order,
            'order', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $private_networks,
            'private_networks', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $private_nic_mac_address,
            'private_nic_mac_address', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $servers,
            'servers', // param base name
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
     * Operation serverAction
     *
     * Perform action
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  \OpenAPI\Client\Model\ServerActionRequest $server_action_request server_action_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['serverAction'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ServerActionResponse
     */
    public function serverAction($zone, $server_id, $server_action_request, string $contentType = self::contentTypes['serverAction'][0])
    {
        list($response) = $this->serverActionWithHttpInfo($zone, $server_id, $server_action_request, $contentType);
        return $response;
    }

    /**
     * Operation serverActionWithHttpInfo
     *
     * Perform action
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  \OpenAPI\Client\Model\ServerActionRequest $server_action_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['serverAction'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1ServerActionResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function serverActionWithHttpInfo($zone, $server_id, $server_action_request, string $contentType = self::contentTypes['serverAction'][0])
    {
        $request = $this->serverActionRequest($zone, $server_id, $server_action_request, $contentType);

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
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1ServerActionResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1ServerActionResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1ServerActionResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1ServerActionResponse';
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
                        '\OpenAPI\Client\Model\ScalewayInstanceV1ServerActionResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation serverActionAsync
     *
     * Perform action
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  \OpenAPI\Client\Model\ServerActionRequest $server_action_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['serverAction'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function serverActionAsync($zone, $server_id, $server_action_request, string $contentType = self::contentTypes['serverAction'][0])
    {
        return $this->serverActionAsyncWithHttpInfo($zone, $server_id, $server_action_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation serverActionAsyncWithHttpInfo
     *
     * Perform action
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  \OpenAPI\Client\Model\ServerActionRequest $server_action_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['serverAction'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function serverActionAsyncWithHttpInfo($zone, $server_id, $server_action_request, string $contentType = self::contentTypes['serverAction'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1ServerActionResponse';
        $request = $this->serverActionRequest($zone, $server_id, $server_action_request, $contentType);

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
     * Create request for operation 'serverAction'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  \OpenAPI\Client\Model\ServerActionRequest $server_action_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['serverAction'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function serverActionRequest($zone, $server_id, $server_action_request, string $contentType = self::contentTypes['serverAction'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling serverAction'
            );
        }

        // verify the required parameter 'server_id' is set
        if ($server_id === null || (is_array($server_id) && count($server_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $server_id when calling serverAction'
            );
        }

        // verify the required parameter 'server_action_request' is set
        if ($server_action_request === null || (is_array($server_action_request) && count($server_action_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $server_action_request when calling serverAction'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/servers/{server_id}/action';
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
        if ($server_id !== null) {
            $resourcePath = str_replace(
                '{' . 'server_id' . '}',
                ObjectSerializer::toPathValue($server_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($server_action_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($server_action_request));
            } else {
                $httpBody = $server_action_request;
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
     * Operation updateServer
     *
     * Update an Instance
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  \OpenAPI\Client\Model\UpdateServerRequest $update_server_request update_server_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateServer'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1UpdateServerResponse
     */
    public function updateServer($zone, $server_id, $update_server_request, string $contentType = self::contentTypes['updateServer'][0])
    {
        list($response) = $this->updateServerWithHttpInfo($zone, $server_id, $update_server_request, $contentType);
        return $response;
    }

    /**
     * Operation updateServerWithHttpInfo
     *
     * Update an Instance
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  \OpenAPI\Client\Model\UpdateServerRequest $update_server_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateServer'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1UpdateServerResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateServerWithHttpInfo($zone, $server_id, $update_server_request, string $contentType = self::contentTypes['updateServer'][0])
    {
        $request = $this->updateServerRequest($zone, $server_id, $update_server_request, $contentType);

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
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1UpdateServerResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1UpdateServerResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1UpdateServerResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1UpdateServerResponse';
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
                        '\OpenAPI\Client\Model\ScalewayInstanceV1UpdateServerResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation updateServerAsync
     *
     * Update an Instance
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  \OpenAPI\Client\Model\UpdateServerRequest $update_server_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateServer'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateServerAsync($zone, $server_id, $update_server_request, string $contentType = self::contentTypes['updateServer'][0])
    {
        return $this->updateServerAsyncWithHttpInfo($zone, $server_id, $update_server_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateServerAsyncWithHttpInfo
     *
     * Update an Instance
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  \OpenAPI\Client\Model\UpdateServerRequest $update_server_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateServer'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function updateServerAsyncWithHttpInfo($zone, $server_id, $update_server_request, string $contentType = self::contentTypes['updateServer'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1UpdateServerResponse';
        $request = $this->updateServerRequest($zone, $server_id, $update_server_request, $contentType);

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
     * Create request for operation 'updateServer'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  \OpenAPI\Client\Model\UpdateServerRequest $update_server_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['updateServer'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function updateServerRequest($zone, $server_id, $update_server_request, string $contentType = self::contentTypes['updateServer'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling updateServer'
            );
        }

        // verify the required parameter 'server_id' is set
        if ($server_id === null || (is_array($server_id) && count($server_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $server_id when calling updateServer'
            );
        }

        // verify the required parameter 'update_server_request' is set
        if ($update_server_request === null || (is_array($update_server_request) && count($update_server_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $update_server_request when calling updateServer'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/servers/{server_id}';
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
        if ($server_id !== null) {
            $resourcePath = str_replace(
                '{' . 'server_id' . '}',
                ObjectSerializer::toPathValue($server_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($update_server_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($update_server_request));
            } else {
                $httpBody = $update_server_request;
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
