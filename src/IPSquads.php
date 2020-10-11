<?php

namespace Ipsquads\Php;

class IPSquads
{
    const API_BASE_URL = 'https://api.ipsquads.com';
    protected $provider;

    public function __construct($access_token = null, $settings = [])
    {
        $this->provider = new IPSquadsProvider($access_token, $settings = []);
    }

    /**
     * Get formatted details for an IP address.
     * @param  string $ip_address IP address to look up.
     * @return array IP response data.
     * @throws IPSquadsException
     */
    public function getDetails($ip_address) : \stdClass
    {
        $response_data = $this->provider->getRequestData((string) $ip_address);

        return $response_data;
    }

    /**
     * Get only the Currency Details of an IP address.
     * @param  string $ip_address IP address to look up.
     * @return array IP response data.
     * @throws IPSquadsException
     */
    public function getCurrencyDetails($ip_address) : \stdClass
    {
        $response_data = $this->provider->getRequestData((string) $ip_address, 'currency');

        return $response_data;
    }

    /**
     * Get only the Timezone Details of an IP address.
     * @param  string $ip_address IP address to look up.
     * @return array IP response data.
     * @throws IPSquadsException
     */
    public function getTimezoneDetails($ip_address) : \stdClass
    {
        $response_data = $this->provider->getRequestData((string) $ip_address, 'timezone');

        return $response_data;
    }

    /**
     * Get only the Network Details of an IP address.
     * @param  string $ip_address IP address to look up.
     * @return array IP response data.
     * @throws IPSquadsException
     */
    public function getNetworkDetails($ip_address) : \stdClass
    {
        $response_data = $this->provider->getRequestData((string) $ip_address, 'network');

        return $response_data;
    }
}
