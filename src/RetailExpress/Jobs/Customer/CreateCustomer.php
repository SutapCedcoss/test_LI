<?php

namespace klyp\LightingIllusion\RetailExpress\Jobs\Customer;

use klyp\LightingIllusion\SoapClient\WebStoreClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateCustomer implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(public $customer)
    {
    }

    public function handle()
    {
        $customer = [
            'Customer' => [
                //'CustomReference' => $this->customer->liSite['name'],
                'BillEmail' => $this->customer->email,
                'BillFirstName' => $this->customer->firstName,
                'BillLastName' => $this->customer->lastName,
                'DelAddress' => $this->customer->shippingAddress['addressLine1'],
                'DelAddress2' => $this->customer->shippingAddress['addressLine2'],
                'DelCountry' => $this->customer->shippingAddress['country'],
                'DelMobile' => $this->customer->phone,
                'DelPostCode' => $this->customer->shippingAddress['postcode'],
                'DelState' => $this->customer->shippingAddress['state'],
                'DelSuburb' => $this->customer->shippingAddress['suburb'],
                'BillAddress' => $this->customer->billingAddress['addressLine1'],
                'BillAddress2' => $this->customer->billingAddress['addressLine2'],
                'BillCountry' => $this->customer->billingAddress['country'],
                'BillMobile' => $this->customer->phone,
                'BillPostCode' => $this->customer->billingAddress['postcode'],
                'BillState' => $this->customer->billingAddress['state'],
                'BillSuburb' => $this->customer->billingAddress['suburb'],
                'Password' => $this->customer->phone,
                'ExternalCustomerId' => $this->customer->id,
                'ReceivesNews' => 0,
            ],
        ];

        $response = (new WebStoreClient())->customerCreateUpdate($customer, 'Customers', 'CustomerXML');
        dd($response);

        $response = json_decode(json_encode(simplexml_load_string($response->CustomerCreateUpdateResult->any)),TRUE);

        if($response && $response['Customer']['Result'] === "Success"){
           $this->customer->update(['rx_id' => $response['Customer']['CustomerId'] ]);
        }
    }
}
