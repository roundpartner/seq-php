<?php

namespace RoundPartner\Seq;

use GuzzleHttp\Client;

class Seq
{

    /**
     * @var Client
     */
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://0.0.0.0:6060'
        ]);
    }

    /**
     * @return mixed
     */
    public function get()
    {
        $response = $this->client->get('');
        $content = $response->getBody()->getContents();
        if (!$this->validate($content, $response->getHeader('HMAC'))) {
            return null;
        }
        $jsonObject = (array) json_decode($content);
        if (empty($jsonObject)) {
            return null;
        }
        return $jsonObject;
    }

    /**
     * @param string $body
     * @param string[] $header
     *
     * @return bool
     */
    private function validate($body, $header)
    {
        $digest = array_shift($header);
        $validator = new HMAC('an example key');
        if (false === $validator->validate($body, $digest)) {
            return false;
        }
        return true;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function post($data)
    {
        $response = $this->client->post('', [
            'body' => json_encode($data)
        ]);
        if (204 !== $response->getStatusCode()) {
            return false;
        }
        return true;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function delete($id)
    {
        $response = $this->client->delete('/' . $id, ['http_errors' => false]);
        if (204 !== $response->getStatusCode()) {
            return false;
        }
        return true;
    }

    /**
     * @param Client $client
     *
     * @return $this
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }
}
