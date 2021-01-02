<?php

namespace klyp\LightingIllusion\RetailExpress\Jobs\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use klyp\LightingIllusion\SoapClient\WebStoreClient;

class UpdateCustomer implements ShouldQueue
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
                //  'CustomReference' => $this->customer->liSite['name'],
                'CustomerId' => $this->customer->rx_id,
                'BillEmail' => $this->customer->email,
                'BillFirstName' => $this->customer->first_name,
                'BillLastName' => $this->customer->last_name,
                'DelAddress' => $this->customer->shippingAddress->address_line1,
                'DelAddress2' => $this->customer->shippingAddress->address_line2,
                'DelCountry' => $this->customer->shippingAddress->country,
                'DelMobile' => $this->customer->phone,
                'DelPostCode' => $this->customer->shippingAddress->postcode,
                'DelState' => $this->customer->shippingAddress->state,
                'DelSuburb' => $this->customer->shippingAddress->suburb,
                'BillAddress' => $this->customer->billingAddress->address_line1,
                'BillAddress2' => $this->customer->billingAddress->address_line2,
                'BillCountry' => $this->customer->billingAddress->country,
                'BillMobile' => $this->customer->phone,
                'BillPostCode' => $this->customer->billingAddress->postcode,
                'BillState' => $this->customer->billingAddress->state,
                'BillSuburb' => $this->customer->billingAddress->suburb,
                'Password' => $this->customer->phone,
                'ExternalCustomerId' => $this->customer->id,
                'ReceivesNews' => 0,
            ],
        ];


        $response = (new WebStoreClient())->customerCreateUpdate($customer, 'Customers', 'CustomerXML');

        json_decode(json_encode(simplexml_load_string($response->CustomerCreateUpdateResult->any)), TRUE);
    }
}
