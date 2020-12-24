<?php

namespace LightningIllusion\RetailExpress;

use Illuminate\Support\ServiceProvider;

class RetailExpressServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'retailExpress');
    }

    public function register()
    {
    }
}
