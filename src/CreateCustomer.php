<?php

namespace klyp\LightingIllusion;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Models\RetailExpressQueue;

class CreateCustomer implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(public int $value = 1)
    {
    }


    public function handle(): RetailExpressQueue
    {

        $new =  new RetailExpressQueue([ 'value' => $this->value]);

        $new->save();

        return $new;
    }
}
