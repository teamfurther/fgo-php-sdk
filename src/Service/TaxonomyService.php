<?php

namespace FGO\Service;

class TaxonomyService extends AbstractService
{
    public function banks()
    {
        return $this->client->request(
            'GET',
            'nomenclator/banca'
        );
    }

    public function cities($county)
    {
        return $this->client->request(
            'GET',
            'nomenclator/localitati?judet=' . $county
        );
    }

    public function clientTypes()
    {
        return $this->client->request(
            'GET',
            'nomenclator/tipclient'
        );
    }

    public function countries()
    {
        return $this->client->request(
            'GET',
            'nomenclator/tara'
        );
    }

    public function counties()
    {
        return $this->client->request(
            'GET',
            'nomenclator/judet'
        );
    }

    public function invoiceTypes()
    {
        return $this->client->request(
            'GET',
            'nomenclator/tipfactura'
        );
    }

    public function receiptTypes()
    {
        return $this->client->request(
            'GET',
            'nomenclator/tipincasare'
        );
    }

    public function vatOptions()
    {
        return $this->client->request(
            'GET',
            'nomenclator/tva'
        );
    }
}