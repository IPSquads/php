<?php

namespace Ipsquads\Php;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class IPSquadsProvider
{
    const API_BASE_URL = 'https://api.ipsquads.com';
    public $access_token;

    public function __construct($access_token = null, $settings = [])
    {
        $this->access_token = $access_token;
    }

    /**
     * Get details of IP Address from IP Squads server
     *
     * @param  string $ip_address
     * @return array IP response data.
     * @throws IPSquadsException
     */
    public function getRequestData(string $ip_address, string $req_for = 'ip-details') : \stdClass
    {
        $url = $this->buildUrl($ip_address, $req_for);

        try {
            $response = (new Client())->request(
                'GET',
                $url,
                $this->buildHeaders()
            );
        } catch (GuzzleException $e) {
            throw new IPSquadsException($e->getMessage());
        } catch (Exception $e) {
            throw new IPSquadsException($e->getMessage());
        }

        if ($response->getStatusCode() >= 400) {
            throw new IPSquadsException('Exception: ' . json_encode([
            'status' => $response->getStatusCode(),
            'reason' => $response->getReasonPhrase(),
            ]));
        }

        $raw_details = json_decode($response->getBody(), false);

        return $raw_details;
    }
    
    /**
     * Build URL by requested for information
     *
     * @param  string $ip_address
     * @param  string $req_for
     * @return string Absolute URL
     */
    public function buildUrl(string $ip_address, string $req_for) : string
    {
        $url = self::API_BASE_URL;
        $url .= "/".$req_for."?ip=$ip_address";

        return $url;
    }

    /**
     * Build headers for API request.
     * @return array Headers for API request.
     */
    public function buildHeaders() : array
    {
        $headers = [
            'user-agent' => 'IPSquadsClient/PHP/1.0',
            'accept' => 'application/json',
        ];

        if ($this->access_token) {
            $headers['authorization'] = "Bearer {$this->access_token}";
        }

        return ['headers' => $headers];
    }
}