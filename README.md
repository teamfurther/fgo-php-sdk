The FGO PHP SDK provides convenient access to the [FGO API](https://testapp.fgo.ro/publicws/files/specificatii-api-latest.pdf) from applications written in the PHP language.

## Installation
You can install the package via composer:

```composer require teamfurther/fgo-php-sdk```

### Tailwind config
There is a default Tailwind configuration included with this package. In order to enjoy all Cinderblock features, you should copy and extend this config.

## Getting Started

Sample usage:

```php
$client = new FGOClient(
    key: 'FGOKEY1234567890',
    merchantName: 'Your Company As Registered on FGO.ro Ltd.',
    merchantTaxId: 'RO12345678',
    platformUrl: $_SERVER['HTTP_HOST'],
    environment: FGOClient::ENV_PRODUCTION,
);

$invoice = $client->invoice->create([
    'Client' => [
        'CodUnic' => '79792323',
        'Denumire' => 'Client SRL',
        'Tip' => 'PJ',
    ],
    'Continut' => [
        [
            'Denumire' => 'Abonament',
            'NrProduse' => 1,
            'PretUnitar' => 45,
            'CotaTVA' => 19,
            'UM' => 'lună',
        ],
    ],
    'Serie' => 'KOMPZT',
    'TipFactura' => 'Factura',
    'Valuta' => 'RON',
]);
```

__NOTE:__ You do not have include ```CodUnic or PlatformaURL``` values in the request body for each call. These will be automatically appended from the initial client configuration.

Similarly, you don't have to include ```Hash```. This will be automatically generated and appended to the request body.

If you include these values, they will override the default client configuration.

## Available Methods
| FGO Controller | FGO Method                  | SDK Call                                |
|----------------|-----------------------------|-----------------------------------------|
| /nomenclator   | /tara                       | $client->taxonomy->countries()          |
|                | /judet                      | $client->taxonomy->counties()           |
|                | /tva                        | $client->taxonomy->vatOptions()         |
|                | /banca                      | $client->taxonomy->banks()              |
|                | /tipincasare                | $client->taxonomy->receiptTypes()       |
|                | /tipfactura                 | $client->taxonomy->invoiceTypes()       |
|                | /tipclient                  | $client->taxonomy->clientTypes()        |
|                | /localitati?judet=<<judet>> | $client->taxonomy->cities($county)      |
| /factura       | /emitere                    | $client->invoice->create($body)         |
|                | /print                      | $client->invoice->print($body)          |
|                | /stergere                   | $client->invoice->delete($body)         |
|                | /anulare                    | $client->invoice->cancel($body)         |
|                | /incasare                   | $client->invoice->createReceipt($body)  |
|                | /stergereincasare           | $client->invoice->deleteReceipt($body)  |
|                | /stornare                   | $client->invoice->storno($body)         |
|                | /awb                        | $client->invoice->awb($body)            |
|                | /listfacturiasociate        | $client->invoice->related($body)        |
| /articol       | /list                       | $client->article->list($body)           |
|                | /get                        | $client->article->get($body)            |
|                | /articolemodificate         | $client->article->modified($body)       |
|                | /gestiune                   | $client->article->inventoryTypes($body) |

Check out [FGO API](https://testapp.fgo.ro/publicws/files/specificatii-api-latest.pdf) for more information.