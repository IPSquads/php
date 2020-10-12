<?php

namespace Ipsquads\Php;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class IPSquadsProvider
{
    const API_BASE_URL = 'https://api.ipsquads.com';
    public $access_token;
    public $cache_adapter;
    public $expires_after;

    public function __construct($access_token = null, $settings = [])
    {
        $this->access_token = $access_token;
        $this->cache_adapter = new FilesystemAdapter();
        $this->expires_after = 3600;
        if (isset($settings['cache_adapter']) && ! empty($settings['cache_adapter'])) {
            $this->cache_adapter = $settings['cache_adapter'];
        }
        if (isset($settings['access_token']) && ! empty($settings['access_token'])) {
            $this->access_token = $settings['access_token'];
        }
        if (isset($settings['expires_after']) && ! empty($this->expires_after)) {
            $this->expires_after = $settings['expires_after'];
        }
    }
    
    /**
     * Get details of IP Address from IP Squads server
     *
     * @param  string $ip_address
     * @return array IP response data.
     * @throws IPSquadsException
     */
    public function getRequestDataFromRemoteServer(string $url) : \stdClass
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->buildHeaders());
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($http_code != 200) {
                throw new IPSquadsException('Exception: ' . json_encode([
                    'status' => $http_code,
                    'reason' => $response,
                ]));
            }
            curl_close($ch);
        } catch (Exception $e) {
            throw new IPSquadsException($e->getMessage());
        }

        return json_decode($response, false);
    }

    /**
     * Get details of IP Address from Cache or IP Squads Server if not found in cache.
     *
     * @param  string $ip_address
     * @return array IP response data.
     * @throws IPSquadsException
     */
    public function getRequestData(string $ip_address, string $req_for = 'ip-details') : \stdClass
    {
        $url = $this->buildUrl($ip_address, $req_for);
        // $cache->delete($ip_address);
        // The callable will only be executed on a cache miss.
        $value = $this->cache_adapter->get($ip_address, function (ItemInterface $item) use ($url) {
            $item->expiresAfter($this->expires_after);
            $ip_data = $this->getRequestDataFromRemoteServer($url);

            return $ip_data;
        });

        return $value;
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

        return $headers;
    }
}
