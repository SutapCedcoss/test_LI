<?php

namespace klyp\LightingIllusion\SoapClient;

/**
 * Class RetailExpressClient
 *
 * @method customerCreateUpdate(array $data, string $rootElement, string $root)
 */
class WebStoreClient
{
    public const WSDL_FILE = 'WebStore.xml';

    public BaseSoapClient $client;

    public function __construct()
    {
        try {
            $this->client = new BaseSoapClient(dirname(__DIR__) . 'resources/wsdl/' . self::WSDL_FILE);
        } catch (\SoapFault $e) {
            throw new \Error($e->getMessage());
        }
    }

    public function __call($name, $arg)
    {
        // root element and root data holder
        $this->setBody($arg[0], $arg[1], $arg[2]);

        try {
            return $this->client->call($name);
        } catch (\Exception $e) {
            print $e->getMessage();
            print $this->client->__getLastRequest();
            print $this->client->__getLastRequestHeaders();
        }
    }

    // root element = customers, root => customer xml
    public function setBody($data, $rootElement, $root): void
    {
        $this->client->setBody($this->client->convertXmlData($data, $rootElement), $root);
    }
}
