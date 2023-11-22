<?php

namespace FGO;

use FGO\Service\ServiceFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class FGOClient
{
    public const ENV_PRODUCTION = 'production';
    public const ENV_TEST = 'test';

    private const URL_PRODUCTION = 'https://api.fgo.ro/v1/';
    private const URL_TEST = 'http://testapp.fgo.ro/publicws/';

    private string $baseUrl = self::URL_PRODUCTION;
    private Client $client;
    private string $environment = self::ENV_PRODUCTION;
    private string $hash;
    private string $key;
    private string $merchantName;
    private string $merchantTaxId;
    private string $platformUrl;

    private $serviceFactory;

    public function __construct(
        string $key,
        string $merchantName,
        string $merchantTaxId,
        string $platformUrl,
        string $environment = self::ENV_PRODUCTION
    )
    {
        if ($environment !== self::ENV_PRODUCTION && $environment !== self::ENV_TEST) {
            throw new \InvalidArgumentException('Invalid environment.');
        }

        $this->environment = $environment;
        $this->key = $key;
        $this->merchantName = $merchantName;
        $this->merchantTaxId = $merchantTaxId;
        $this->platformUrl = $platformUrl;

        $this->baseUrl = $this->environment === self::ENV_PRODUCTION ? self::URL_PRODUCTION : self::URL_TEST;

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);
    }

    public function __get($name)
    {
        return $this->getService($name);
    }

    public function generateHash(string $string): string
    {
        return strtoupper(SHA1($string));
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getMerchantTaxId(): string
    {
        return $this->merchantTaxId;
    }

    public function getService($name)
    {
        if (null === $this->serviceFactory) {
            $this->serviceFactory = new ServiceFactory($this);
        }

        return $this->serviceFactory->getService($name);
    }

    public function request(string $method, string $path, array $body = []): array {
        $body['CodUnic'] = $body['CodUnic'] ?? $this->merchantTaxId;
        $body['PlatformaUrl'] = $body['PlatformaUrl'] ?? $this->platformUrl;

        $response = $this->client->request($method, $path, [
            'form_params' => $body,
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception($response->getReasonPhrase());
        }

        $responseContent = json_decode($response->getBody(), true);

        if (!$responseContent['Success']) {
            throw new \Exception($responseContent['Message']);
        }

        return $responseContent;
    }
}