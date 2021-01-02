<?php

namespace klyp\LightingIllusion\SoapClient;

use SoapClient;
use SoapFault;
use SoapHeader;
use SoapVar;
use Spatie\ArrayToXml\ArrayToXml;

/**
 * Class BaseSoapClient
 * @package App\Services\RetailExpressApi
 * @method CustomerCreateUpdate($data)
 */
class BaseSoapClient
{
    private const NAMESPACE = 'http://retailexpress.com.au/';

    private SoapClient $soapClient;

    private SoapVar $body;

    private array $clientHeaders = [];

    /**
     * BaseSoapClient constructor.
     *
     * @param string $wsdl full path to wsdl file
     *
     * @throws SoapFault
     */
    public function __construct(string $wsdl)
    {
        $this->soapClient = new \SoapClient(
            $wsdl,
            [
                'trace' => 1,
                'exceptions' => true,
                'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
                'use' => SOAP_LITERAL,
                'soap_version' => SOAP_1_2
            ]
        );
        $this->setHeaders();
    }

    protected function setHeaders(array $headers = []): void
    {
        if (empty($headers)) {
            $headers = [
                'ClientID' => config('app.retail_express.client_id'),
                'UserName' => config('app.retail_express.username'),
                'Password' => config('app.retail_express.password'),
            ];
        }


        $this->soapClient->__setSoapHeaders(
            new SoapHeader(
                self::NAMESPACE,
                'ClientHeader',
                (object)$headers,
                false
            )
        );
    }

    public function setBody(string $data, string $paramName): void
    {
        $params[] = new \SoapVar(
            $data,
            XSD_STRING,
            nodeName: $paramName,
            nodeNamespace: self::NAMESPACE,
        );

        $this->body = (new SoapVar($params, SOAP_ENC_OBJECT));
    }

    public function convertXmlData(array $data, string $root = ''): string
    {
        return (new ArrayToXml($data, $root))->dropXmlDeclaration()->toXml();
    }

    public function call(string $method)
    {
        return $this->soapClient->{$method}($this->body);
    }
}
