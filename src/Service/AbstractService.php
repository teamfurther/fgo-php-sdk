<?php

namespace FGO\Service;

use FGO\FGOClient;

abstract class AbstractService
{
    protected FGOClient $client;

    public function __construct(FGOClient $client)
    {
        $this->client = $client;
    }
}