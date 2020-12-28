<?php

namespace klyp\LightingIllusion\RetailExpress\Jobs;

use klyp\LightingIllusion\SoapClient\RetailExpressClient;
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

    public function __construct()
    {
    }


    public function handle($customer, $data)
    {
        $customerData = [
            'Customer' => [
                'BillEmail' => $data->email,
                'BillFirstName' => $data->firstName,
                'BillLastName' => $data->lastName,
                'DelAddress' => $data->shipping_address['addressLine1'],
                'DelAddress2' => $data->shipping_address['addressLine2'],
                'DelCountry' => $data->shipping_address['country'],
                'DelMobile' => $data['phone'],
                'DelPostCode' => $data->shipping_address['postcode'],
                'DelState' => $data->shipping_address['state'],
                'DelSuburb' => $data->shipping_address['suburb'],
                'BillAddress' => $data->billing_address['addressLine1'],
                'BillAddress2' => $data->billing_address['addressLine2'],
                'BillCountry' => $data->billing_address['country'],
                'BillMobile' => $data['phone'],
                'BillPostCode' => $data->billing_address['postcode'],
                'BillState' => $data->billing_address['state'],
                'BillSuburb' => $data->billing_address['suburbBill'],
                'Password' => $data->password,
                'ReceivesNews' => 0,
            ],
        ];

        $response =  (new RetailExpressClient())
            ->customerCreateUpdate($customerData);
        dd($response);
        // return $new;
    }
}
