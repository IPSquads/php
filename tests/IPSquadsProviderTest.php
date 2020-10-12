<?php

namespace Ipsquads\Php\Tests;

use Ipsquads\Php\IPSquads;
use Ipsquads\Php\IPSquadsProvider;
use PHPUnit\Framework\TestCase;

class IPSquadsProviderTest extends TestCase
{
    /** @test */
    public function testBuildUrl()
    {
        $url = (new IPSquadsProvider)->buildUrl('54.70.143.245', 'ip-details');
        $this->assertEquals($url, 'https://api.ipsquads.com/ip-details?ip=54.70.143.245');
    }

    public function testBuildHeaders()
    {
        $headers = (new IPSquadsProvider)->buildHeaders();
        $this->assertEquals($headers['accept'], 'application/json');
        $this->assertEquals($headers['user-agent'], 'IPSquadsClient/PHP/1.0');
    }

    public function testGetRequestData()
    {
        $headers = (new IPSquadsProvider)->getRequestData('54.70.143.245', 'ip-details');
        $this->assertEquals("", "");
    }

    public function testGetDetails()
    {
        $ip_squads = new IPSquads('FREE');
        $ip_data = $ip_squads->getDetails('54.70.143.245');
        $this->assertNotEmpty($ip_data->currency);
        $this->assertNotEmpty($ip_data->asn);
        $this->assertNotEmpty($ip_data->location);
        $this->assertNotEmpty($ip_data->timezone);
        $this->assertNotEmpty($ip_data->currency);
    }

    public function testGetCurrencyDetails()
    {
        $ip_squads = new IPSquads('FREE');
        $ip_data = $ip_squads->getCurrencyDetails('54.70.143.245');
        $this->assertEquals('Dollar', $ip_data->name);
        $this->assertEquals('USD', $ip_data->code);
    }

    public function testGetTimezoneDetails()
    {
        $ip_squads = new IPSquads('FREE');
        $ip_data = $ip_squads->getTimezoneDetails('54.70.143.245');
        $this->assertNotEmpty($ip_data->code);
        $this->assertNotEmpty($ip_data->dst_offset);
        $this->assertNotEmpty($ip_data->gmt_offset);
        $this->assertNotEmpty($ip_data->current_time);
        $this->assertNotEmpty($ip_data->current_time_unix);
    }

    public function testGetNetworkDetails()
    {
        $ip_squads = new IPSquads('FREE');
        $ip_data = $ip_squads->getNetworkDetails('54.70.143.245');
        $this->assertNotEmpty($ip_data->asn);
        $this->assertNotEmpty($ip_data->asn_org);
    }
}
