<?php
/**
 * UserDataApi
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
 * UserDataApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class UserDataApi
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
        'deleteServerUserData' => [
            'application/json',
        ],
        'getServerUserData' => [
            'application/json',
        ],
        'listServerUserData' => [
            'application/json',
        ],
        'setServerUserData' => [
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
     * Operation deleteServerUserData
     *
     * Delete user data
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $key Key of the user data to delete. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteServerUserData'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteServerUserData($zone, $server_id, $key, string $contentType = self::contentTypes['deleteServerUserData'][0])
    {
        $this->deleteServerUserDataWithHttpInfo($zone, $server_id, $key, $contentType);
    }

    /**
     * Operation deleteServerUserDataWithHttpInfo
     *
     * Delete user data
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $key Key of the user data to delete. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteServerUserData'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteServerUserDataWithHttpInfo($zone, $server_id, $key, string $contentType = self::contentTypes['deleteServerUserData'][0])
    {
        $request = $this->deleteServerUserDataRequest($zone, $server_id, $key, $contentType);

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
     * Operation deleteServerUserDataAsync
     *
     * Delete user data
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $key Key of the user data to delete. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteServerUserData'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteServerUserDataAsync($zone, $server_id, $key, string $contentType = self::contentTypes['deleteServerUserData'][0])
    {
        return $this->deleteServerUserDataAsyncWithHttpInfo($zone, $server_id, $key, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteServerUserDataAsyncWithHttpInfo
     *
     * Delete user data
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $key Key of the user data to delete. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteServerUserData'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteServerUserDataAsyncWithHttpInfo($zone, $server_id, $key, string $contentType = self::contentTypes['deleteServerUserData'][0])
    {
        $returnType = '';
        $request = $this->deleteServerUserDataRequest($zone, $server_id, $key, $contentType);

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
     * Create request for operation 'deleteServerUserData'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $key Key of the user data to delete. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteServerUserData'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteServerUserDataRequest($zone, $server_id, $key, string $contentType = self::contentTypes['deleteServerUserData'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling deleteServerUserData'
            );
        }

        // verify the required parameter 'server_id' is set
        if ($server_id === null || (is_array($server_id) && count($server_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $server_id when calling deleteServerUserData'
            );
        }

        // verify the required parameter 'key' is set
        if ($key === null || (is_array($key) && count($key) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $key when calling deleteServerUserData'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/servers/{server_id}/user_data/{key}';
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
        // path params
        if ($key !== null) {
            $resourcePath = str_replace(
                '{' . 'key' . '}',
                ObjectSerializer::toPathValue($key),
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
     * Operation getServerUserData
     *
     * Get user data
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $key Key of the user data to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getServerUserData'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayStdFile
     */
    public function getServerUserData($zone, $server_id, $key, string $contentType = self::contentTypes['getServerUserData'][0])
    {
        list($response) = $this->getServerUserDataWithHttpInfo($zone, $server_id, $key, $contentType);
        return $response;
    }

    /**
     * Operation getServerUserDataWithHttpInfo
     *
     * Get user data
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $key Key of the user data to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getServerUserData'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayStdFile, HTTP status code, HTTP response headers (array of strings)
     */
    public function getServerUserDataWithHttpInfo($zone, $server_id, $key, string $contentType = self::contentTypes['getServerUserData'][0])
    {
        $request = $this->getServerUserDataRequest($zone, $server_id, $key, $contentType);

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
                    if ('\OpenAPI\Client\Model\ScalewayStdFile' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayStdFile' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayStdFile', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayStdFile';
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
                        '\OpenAPI\Client\Model\ScalewayStdFile',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getServerUserDataAsync
     *
     * Get user data
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $key Key of the user data to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getServerUserData'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getServerUserDataAsync($zone, $server_id, $key, string $contentType = self::contentTypes['getServerUserData'][0])
    {
        return $this->getServerUserDataAsyncWithHttpInfo($zone, $server_id, $key, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getServerUserDataAsyncWithHttpInfo
     *
     * Get user data
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $key Key of the user data to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getServerUserData'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getServerUserDataAsyncWithHttpInfo($zone, $server_id, $key, string $contentType = self::contentTypes['getServerUserData'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayStdFile';
        $request = $this->getServerUserDataRequest($zone, $server_id, $key, $contentType);

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
     * Create request for operation 'getServerUserData'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $key Key of the user data to get. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getServerUserData'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getServerUserDataRequest($zone, $server_id, $key, string $contentType = self::contentTypes['getServerUserData'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling getServerUserData'
            );
        }

        // verify the required parameter 'server_id' is set
        if ($server_id === null || (is_array($server_id) && count($server_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $server_id when calling getServerUserData'
            );
        }

        // verify the required parameter 'key' is set
        if ($key === null || (is_array($key) && count($key) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $key when calling getServerUserData'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/servers/{server_id}/user_data/{key}';
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
        // path params
        if ($key !== null) {
            $resourcePath = str_replace(
                '{' . 'key' . '}',
                ObjectSerializer::toPathValue($key),
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
     * Operation listServerUserData
     *
     * List user data
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listServerUserData'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\ScalewayInstanceV1ListServerUserDataResponse
     */
    public function listServerUserData($zone, $server_id, string $contentType = self::contentTypes['listServerUserData'][0])
    {
        list($response) = $this->listServerUserDataWithHttpInfo($zone, $server_id, $contentType);
        return $response;
    }

    /**
     * Operation listServerUserDataWithHttpInfo
     *
     * List user data
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listServerUserData'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\ScalewayInstanceV1ListServerUserDataResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function listServerUserDataWithHttpInfo($zone, $server_id, string $contentType = self::contentTypes['listServerUserData'][0])
    {
        $request = $this->listServerUserDataRequest($zone, $server_id, $contentType);

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
                    if ('\OpenAPI\Client\Model\ScalewayInstanceV1ListServerUserDataResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\OpenAPI\Client\Model\ScalewayInstanceV1ListServerUserDataResponse' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ScalewayInstanceV1ListServerUserDataResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1ListServerUserDataResponse';
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
                        '\OpenAPI\Client\Model\ScalewayInstanceV1ListServerUserDataResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation listServerUserDataAsync
     *
     * List user data
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listServerUserData'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listServerUserDataAsync($zone, $server_id, string $contentType = self::contentTypes['listServerUserData'][0])
    {
        return $this->listServerUserDataAsyncWithHttpInfo($zone, $server_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listServerUserDataAsyncWithHttpInfo
     *
     * List user data
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listServerUserData'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listServerUserDataAsyncWithHttpInfo($zone, $server_id, string $contentType = self::contentTypes['listServerUserData'][0])
    {
        $returnType = '\OpenAPI\Client\Model\ScalewayInstanceV1ListServerUserDataResponse';
        $request = $this->listServerUserDataRequest($zone, $server_id, $contentType);

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
     * Create request for operation 'listServerUserData'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listServerUserData'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function listServerUserDataRequest($zone, $server_id, string $contentType = self::contentTypes['listServerUserData'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling listServerUserData'
            );
        }

        // verify the required parameter 'server_id' is set
        if ($server_id === null || (is_array($server_id) && count($server_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $server_id when calling listServerUserData'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/servers/{server_id}/user_data';
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
     * Operation setServerUserData
     *
     * Add/set user data
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $key Key of the user data to set. (required)
     * @param  \SplFileObject $body body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setServerUserData'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function setServerUserData($zone, $server_id, $key, $body, string $contentType = self::contentTypes['setServerUserData'][0])
    {
        $this->setServerUserDataWithHttpInfo($zone, $server_id, $key, $body, $contentType);
    }

    /**
     * Operation setServerUserDataWithHttpInfo
     *
     * Add/set user data
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $key Key of the user data to set. (required)
     * @param  \SplFileObject $body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setServerUserData'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function setServerUserDataWithHttpInfo($zone, $server_id, $key, $body, string $contentType = self::contentTypes['setServerUserData'][0])
    {
        $request = $this->setServerUserDataRequest($zone, $server_id, $key, $body, $contentType);

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
     * Operation setServerUserDataAsync
     *
     * Add/set user data
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $key Key of the user data to set. (required)
     * @param  \SplFileObject $body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setServerUserData'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setServerUserDataAsync($zone, $server_id, $key, $body, string $contentType = self::contentTypes['setServerUserData'][0])
    {
        return $this->setServerUserDataAsyncWithHttpInfo($zone, $server_id, $key, $body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation setServerUserDataAsyncWithHttpInfo
     *
     * Add/set user data
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $key Key of the user data to set. (required)
     * @param  \SplFileObject $body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setServerUserData'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setServerUserDataAsyncWithHttpInfo($zone, $server_id, $key, $body, string $contentType = self::contentTypes['setServerUserData'][0])
    {
        $returnType = '';
        $request = $this->setServerUserDataRequest($zone, $server_id, $key, $body, $contentType);

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
     * Create request for operation 'setServerUserData'
     *
     * @param  string $zone The zone you want to target (required)
     * @param  string $server_id UUID of the Instance. (required)
     * @param  string $key Key of the user data to set. (required)
     * @param  \SplFileObject $body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['setServerUserData'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function setServerUserDataRequest($zone, $server_id, $key, $body, string $contentType = self::contentTypes['setServerUserData'][0])
    {

        // verify the required parameter 'zone' is set
        if ($zone === null || (is_array($zone) && count($zone) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $zone when calling setServerUserData'
            );
        }

        // verify the required parameter 'server_id' is set
        if ($server_id === null || (is_array($server_id) && count($server_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $server_id when calling setServerUserData'
            );
        }

        // verify the required parameter 'key' is set
        if ($key === null || (is_array($key) && count($key) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $key when calling setServerUserData'
            );
        }

        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling setServerUserData'
            );
        }


        $resourcePath = '/instance/v1/zones/{zone}/servers/{server_id}/user_data/{key}';
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
        // path params
        if ($key !== null) {
            $resourcePath = str_replace(
                '{' . 'key' . '}',
                ObjectSerializer::toPathValue($key),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            [],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($body));
            } else {
                $httpBody = $body;
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
