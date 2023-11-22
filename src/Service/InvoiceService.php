<?php

namespace FGO\Service;

class InvoiceService extends AbstractService
{
    public function awb(array $body = [])
    {
        $body['Hash'] = $this->client->generateHash(
            $this->client->getMerchantTaxId() . $this->client->getKey() . $body['Numar']
        );

        return $this->client->request(
            'POST',
            'factura/awb',
            $body
        );
    }

    public function cancel(array $body = [])
    {
        $body['Hash'] = $this->client->generateHash(
            $this->client->getMerchantTaxId() . $this->client->getKey() . $body['Numar']
        );

        return $this->client->request(
            'POST',
            'factura/anulare',
            $body
        );
    }

    public function create(array $body = [])
    {
        $body['Hash'] = $this->client->generateHash(
            $this->client->getMerchantTaxId() . $this->client->getKey() . $body['Client']['Denumire']
        );

        return $this->client->request(
            'POST',
            'factura/emitere',
            $body
        );
    }

    public function createReceipt(array $body = [])
    {
        $body['Hash'] = $this->client->generateHash(
            $this->client->getMerchantTaxId() . $this->client->getKey() . $body['Numar']
        );

        return $this->client->request(
            'POST',
            'factura/incasare',
            $body
        );
    }

    public function delete(array $body = [])
    {
        $body['Hash'] = $this->client->generateHash(
            $this->client->getMerchantTaxId() . $this->client->getKey() . $body['Numar']
        );

        return $this->client->request(
            'POST',
            'factura/stergere',
            $body
        );
    }

    public function deleteReceipt(array $body = [])
    {
        $body['Hash'] = $this->client->generateHash(
            $this->client->getMerchantTaxId() . $this->client->getKey() . $body['Numar']
        );

        return $this->client->request(
            'POST',
            'factura/stergereincasare',
            $body
        );
    }

    public function print(array $body = [])
    {
        $body['Hash'] = $this->client->generateHash(
            $this->client->getMerchantTaxId() . $this->client->getKey() . $body['Numar']
        );

        return $this->client->request(
            'POST',
            'factura/print',
            $body
        );
    }

    public function related(array $body = [])
    {
        $body['Hash'] = $this->client->generateHash(
            $this->client->getMerchantTaxId() . $this->client->getKey() . $body['Numar']
        );

        return $this->client->request(
            'POST',
            'factura/listfacturiasociate',
            $body
        );
    }

    public function status(array $body = [])
    {
        $body['Hash'] = $this->client->generateHash(
            $this->client->getMerchantTaxId() . $this->client->getKey() . $body['Numar']
        );

        return $this->client->request(
            'POST',
            'factura/getstatus',
            $body
        );
    }

    public function storno(array $body = [])
    {
        $body['Hash'] = $this->client->generateHash(
            $this->client->getMerchantTaxId() . $this->client->getKey() . $body['Numar']
        );

        return $this->client->request(
            'POST',
            'factura/stornare',
            $body
        );
    }
}