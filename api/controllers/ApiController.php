<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Phalcon\Http\Response;
use GuzzleHttp\Client;
use Baka\Http\Api\BaseController as BakaBaseController;

/**
 * Class IndexController.
 *
 * @package Gewaer\Api\Controllers
 *
 * @property Redis $redis
 * @property Beanstalk $queue
 * @property Mysql $db
 * @property \Monolog\Logger $log
 */
class ApiController extends BakaBaseController
{
    /**
     * @string
     */
    public $apiHeaders = [];

    /**
     * Construct setup setting.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->setApiHeaders([
            'Authorization' => $this->request->hasHeader('Authorization') ? $this->request->getHeader('Authorization') : '',
            'Content-Type' => $this->request->getContentType()
        ]);
    }

    /**
     * Function to set the API headers since the property is protected.
     *
     * @param mixed $version
     *
     * @return void
     */
    public function setApiHeaders($apiHeaders): void
    {
        $this->apiHeaders = $apiHeaders;
    }

    /**
     * Get request options to send.
     *
     * @return array
     */
    public function getRequestData(string $method, array $data): array
    {
        return [
            'headers' => $this->apiHeaders,
            key($data) => $data[key($data)]
        ];
    }

    /**
     * Function tasked with delegating API requests to the configured API.
     *
     * @todo Verify headers being received from the API response before returning the request response.
     *
     * @return \Phalcon\Http\Response
     */
    public function transporter()
    {
        // Get all router params
        $routeParams = $this->router->getParams();

        $url = $this->router->getRewriteUri();
        $method = $this->request->getMethod();

        // Get real API URL
        $apiUrl = getenv('EXT_API_URL') . $url;

        // return $this->response($this->getData());

        // // Execute the request, providing the URL, the request method and the data.
        $response = $this->makeRequest($apiUrl, $method, $this->getData());
        // return $this->response($response);

        //set status code so we can get 404
        if ($response->getStatusCode()) {
            $this->response->setStatusCode($response->getStatusCode());
        }

        if (is_array($response->getHeader('Content-Type'))) {
            $this->response->setContentType($response->getHeader('Content-Type')[0]);
        } else {
            $this->response->setContentType($response->getHeader('Content-Type'));
        }

        return $this->response->setContent($response->getBody());
    }

    /**
     * Function that executes the request to the configured API.
     *
     * @param string $method - The request method
     * @param string $url - The request URL
     * @param array $data - The form data
     *
     * @return JSON
     */
    public function makeRequest($url, $method = 'GET', $data = [])
    {
        $client = new Client();

        $parse = function ($error) {
            if ($error->hasResponse()) {
                return $error->getResponse();
            }

            return json_decode($error->getMessage());
        };

        try {
            $response = $client->request($method, $url, $this->getRequestData($method, $data));
            return $response;
        } catch (\GuzzleHttp\Exception\BadResponseException $error) {
            return $parse($error);
        } catch (\GuzzleHttp\Exception\ClientException $error) {
            return $parse($error);
        } catch (\GuzzleHttp\Exception\ConnectException $error) {
            return $parse($error);
        } catch (\GuzzleHttp\Exception\RequestException $error) {
            return $parse($error);
        }
    }

    /**
     * Function that obtains the data as per the request type.
     *
     * @return array
     */
    public function getData()
    {
        $isJson = strstr($this->request->getContentType(), 'application/json');

        $uploads = [];
        //if the user is trying to upload a image
        if (count($this->request->getUploadedFiles()) > 0) {
            foreach ($this->request->getUploadedFiles() as $file) {
                $uploads[] = new \GuzzleHttp\Post\PostFile('documents[]', file_get_contents($file->getTempName()), $file->getName());
            }

            $parseUpload = function ($request) use (&$uploads) {
                foreach ($request as $key => $value) {
                    if (is_array($value)) {
                        foreach ($value as $f => $v) {
                            $uploads[$key][$f] = $v;
                        }
                    } else {
                        $uploads[$key] = $value;
                    }
                }
            };
        }

        switch ($this->request->getMethod()) {
            case 'GET':
                $queryParams = $this->request->getQuery();
                unset($queryParams['_url']);
                return ['query' => $queryParams];
                break;

            case 'POST':
                if (!$uploads) {
                    return empty($this->request->getPost()) ? ['json' => json_decode($this->request->getRawBody(), true)] : ['form_params' => $this->request->getPost()];
                } else {
                    $parseUpload($this->request->getPost());
                    // return ['multipart' => $uploads];
                    return $uploads;
                }
                break;

            case 'PUT':
                if (!$uploads) {
                    return empty($this->request->getPost()) ? ['json' => json_decode($this->request->getRawBody(), true)] : ['form_params' => $this->request->getPut()];
                } else {
                    $parseUpload($this->request->getPut());
                    return ['multipart' => $uploads];
                }

                break;
            default:
                return [];
                break;
        }
    }

    /**
     * Get the record by its primary key.
     *
     * @param mixed $id
     *
     * @throws Exception
     * @return Response
     */
    public function getById($id): Response
    {
        return $this->transporter();
    }
}
