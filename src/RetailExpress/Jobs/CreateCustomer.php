<?php

namespace klyp\LightingIllusion\RetailExpress\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use klyp\LightingIllusion\SoapClient\WebStoreClient;

class CreateCustomer implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(public $customer, public $data)
    {
    }

    public function handle()
    {
        $customerData = [
            'Customer' => [
                'BillEmail' => $this->data->email,
                'BillFirstName' => $this->data->firstName,
                'BillLastName' => $this->data->lastName,
                'DelAddress' => $this->data->shippingAddress['addressLine1'],
                'DelAddress2' => $this->data->shippingAddress['addressLine2'],
               // 'DelCountry' => $this->data->shippingAddress['country'],
                'DelMobile' => $this->data->phone,
                'DelPostCode' => $this->data->shippingAddress['postcode'],
                'DelState' => $this->data->shippingAddress['state'],
                'DelSuburb' => $this->data->shippingAddress['suburb'],
                'BillAddress' => $this->data->billingAddress['addressLine1'],
                'BillAddress2' => $this->data->billingAddress['addressLine2'],
               // 'BillCountry' => $this->data->billingAddress['country'],
                'BillMobile' => $this->data->phone,
                'BillPostCode' => $this->data->billingAddress['postcode'],
                'BillState' => $this->data->billingAddress['state'],
                'BillSuburb' => $this->data->billingAddress['suburb'],
                'Password' => $this->data->password,
                'ReceivesNews' => 0,
            ],
        ];

        $response =  (new WebStoreClient())->customerCreateUpdate($customerData, 'Customers', 'CustomerXML');

        $response = json_decode(
            json_encode(
                simplexml_load_string(
                    $response->CustomerCreateUpdateResult->any
                )
            ),
            true
        );


        dd($response);
        // return $new;
    }
}
