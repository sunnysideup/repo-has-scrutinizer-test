<?php

namespace Sunnysideup\RepoHasScrutinizerTest;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$packages = ['vendor1/package1', 'vendor2/package2', 'vendor3/package3'];  // Replace with your array

$client = new Client();

foreach ($packages as $package) {

}
class TestQuality
{
    protected function getClient()
    {
        return new Client();
    }

    public function listedOnScrutinizer(string $packageName)
    {
        $client = $this->getClient();
        list($vendor, $package) = explode('/', $packageName);

        $url = "https://scrutinizer-ci.com/g/{$vendor}/{$package}/badges/quality-score.png?b=master";

        try {
            $response = $client->request('GET', $url);

            if ($response->getStatusCode() == 200) {
                return true;
            } else {
                return false;
            }
        } catch (RequestException $e) {
            echo "Error checking Scrutinizer badge for {$vendor}/{$package}: {$e->getMessage()}\n";
        }
    }
}
