<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

abstract class AbstractApiTestCase extends TestCase
{
    const VERSION_PREFIX = '/api';

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     *
     * @return \Illuminate\Testing\TestResponse
     */
    public function getRequest($url, $data = [], $headers = [])
    {
        return $this->json('GET', self::VERSION_PREFIX . $url, $data, $headers);
    }

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     *
     * @return \Illuminate\Testing\TestResponse
     */
    public function postRequest($url, $data = [], $headers = [])
    {
        return $this->json('POST', self::VERSION_PREFIX . $url, $data, $headers);
    }

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     *
     * @return \Illuminate\Testing\TestResponse
     */
    public function deleteRequest($url, $data = [], $headers = [])
    {
        return $this->json('DELETE', self::VERSION_PREFIX . $url, $data, $headers);
    }

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     *
     * @return \Illuminate\Testing\TestResponse
     */
    public function putRequest($url, $data = [], $headers = [])
    {
        return $this->json('PUT', self::VERSION_PREFIX . $url, $data, $headers);
    }
}
