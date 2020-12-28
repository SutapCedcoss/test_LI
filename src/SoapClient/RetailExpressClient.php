<?php

namespace klyp\LightingIllusion\SoapClient;

class RetailExpressClient
{
    public const WSDL_FILE = 'RetailExpressWsdl.xml';

    public BaseSoapClient $client;

    public function __construct()
    {
        $this->client = new BaseSoapClient(base_path('/resources/assets/RetailExpress/') . self::WSDL_FILE);
    }

    public function customerCreateUpdate(array $customerData)
    {
        $this->client->setBody($this->client->convertXmlData($customerData, 'Customers'), 'CustomerXML');

        try {
            return $this->client->call('CustomerCreateUpdate');
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            print_r($client->__getLastRequest());
            print_r($client->__getLastRequestHeaders());
        }
    }
}
