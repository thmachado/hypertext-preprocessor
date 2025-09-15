<?php

declare(strict_types=1);

namespace App\Http;

use CurlHandle;
use RuntimeException;

class Curl
{
    /**
     * Summary of get
     * @param string $url
     * @return array<array<mixed>>
     */
    public function get(string $url): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        return $this->processCurl($curl);
    }

    /**
     * Summary of post
     * @param string $url
     * @param array<int|string> $payload
     * @param array<string> $headers
     * @return array<array<mixed>>
     */
    public function post(string $url, array $payload = [], array $headers = ["Content-Type: application/json"]): array
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => $headers
        ));

        return $this->processCurl($curl);
    }

    /**
     * Summary of processCurl
     * @param \CurlHandle $curl
     * @throws \RuntimeException
     * @return array<array<mixed>>
     */
    private function processCurl(CurlHandle $curl): array
    {
        $response = curl_exec($curl);
        if ($response === false) {
            throw new RuntimeException("cURL error: " . curl_error($curl));
        }

        curl_close($curl);

        if (is_string($response) === false) {
            throw new RuntimeException("cURL did not return a string response");
        }

        $data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException("JSON decode error: " . json_last_error_msg());
        }

        return $data;
    }
}