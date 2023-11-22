<?php

namespace FGO\Service;

class ArticleService extends AbstractService
{
    public function get(array $body = [])
    {
        $body['Hash'] = $this->client->generateHash(
            $this->client->getMerchantTaxId() . $this->client->getKey()
        );

        return $this->client->request(
            'POST',
            'articol/get',
            $body
        );
    }

    public function list(array $body = [])
    {
        $body['Hash'] = $this->client->generateHash(
            $this->client->getMerchantTaxId() . $this->client->getKey()
        );

        return $this->client->request(
            'POST',
            'articol/list',
            $body
        );
    }

    public function modified(array $body = [])
    {
        $body['Hash'] = $this->client->generateHash(
            $this->client->getMerchantTaxId() . $this->client->getKey()
        );

        return $this->client->request(
            'POST',
            'articol/articolemodificate',
            $body
        );
    }

    public function inventoryTypes(array $body = [])
    {
        $body['Hash'] = $this->client->generateHash(
            $this->client->getMerchantTaxId() . $this->client->getKey()
        );

        return $this->client->request(
            'POST',
            'articol/gestiune',
            $body
        );
    }
}