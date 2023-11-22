<?php

namespace FGO\Service;

use FGO\FGOClient;

abstract class AbstractServiceFactory
{
    private FGOClient $client;
    private array $services = [];

    public function __construct(FGOClient $client)
    {
        $this->client = $client;
    }

    abstract protected function getServiceClass(string $name);

    public function __get(string $name)
    {
        return $this->getService($name);
    }

    public function getService(string $name)
    {
        $serviceClass = $this->getServiceClass($name);

        if (null !== $serviceClass) {
            if (!\array_key_exists($name, $this->services)) {
                $this->services[$name] = new $serviceClass($this->client);
            }

            return $this->services[$name];
        }

        \trigger_error('Undefined property: ' . static::class . '::$' . $name);

        return null;
    }
}