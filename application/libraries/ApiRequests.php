<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiRequests
{
    protected $client;
    protected $host;

    public function __construct()
    {
        $this->client = new Client();
        $this->host = 'http://localhost:8000/api/v1/';
        // $this->host = 'https://api.ybbfoundation.com/api/v1/';
    }

    public function post($url, $data = [], $headers = [])
    {
        try {
            $response = $this->client->post("{$this->host}{$url}", [
                'body' => json_encode($data),
                'headers' => $headers
            ]);
            return $this->decodeResponse($response);
        } catch (RequestException $e) {
            // Handle Guzzle RequestException
            return $this->handleException($e);
        }
    }

    public function get($url, $params = [], $headers = [])
    {
        try {
            $response = $this->client->get("{$this->host}{$url}", [
                'query' => $params,
                'headers' => $headers
            ]);
            return $this->decodeResponse($response);
        } catch (RequestException $e) {
            // Handle Guzzle RequestException
            return $this->handleException($e);
        }
    }

    public function put($url, $data = [], $headers = [])
    {
        try {
            $response = $this->client->put("{$this->host}{$url}", [
                'form_params' => $data,
                'headers' => $headers
            ]);
            return $this->decodeResponse($response);
        } catch (RequestException $e) {
            // Handle Guzzle RequestException
            return $this->handleException($e);
        }
    }

    public function delete($url, $data = [], $headers = [])
    {
        try {
            $response = $this->client->delete("{$this->host}{$url}", [
                'form_params' => $data,
                'headers' => $headers
            ]);
            return $this->decodeResponse($response);
        } catch (RequestException $e) {
            // Handle Guzzle RequestException
            return $this->handleException($e);
        }
    }

    protected function decodeResponse($response)
    {
        $contents = $response->getBody()->getContents();
        return json_decode($contents, true);
    }

    protected function handleException($exception)
    {
        if ($exception->hasResponse()) {
            $contents = $exception->getResponse()->getBody()->getContents();
            return json_decode($contents, true);
        } else {
            return ['error' => $exception->getMessage()];
        }
    }
}