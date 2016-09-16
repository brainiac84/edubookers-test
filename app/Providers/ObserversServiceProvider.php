<?php

namespace App\Providers;

use App\Address;
use App\Elastic\Elastic;
use App\Observers\ElasticAddressObserver;
use Illuminate\Support\ServiceProvider;

class ObserversServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Address::observe($this->app->make(ElasticAddressObserver::class));
    }

    public function register()
    {

        $this->app->bind(ElasticAddressObserver::class, function ()
        {
            return new ElasticAddressObserver(
                app(Elastic::class)
            );
        });
    }
}