<?php

namespace Sunnysideup\RepoHasScrutinizerTest;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$client = new Client();

class TestQuality
{
    protected function getClient()
    {
        return new Client();
    }

    public function isListedOnScrutinizer(string $packageName)
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
