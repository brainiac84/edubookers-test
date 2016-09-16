<?php

namespace App\Observers;

use App\Address;
use App\Elastic\Elastic;
use Elasticsearch\Client;

class ElasticAddressObserver
{
    private $client;

    /**
     * ElasticAddressObserver constructor.
     * @param Client $elasticsearch
     */
    public function __construct(Elastic $elasticsearch)
    {
        $this->client = $elasticsearch;
    }

    public function created(Address $item)
    {
        $this->client->index([
            'index' => 'default',
            'type' => 'address',
            'id' => $item->id,
            'body' => $item->toArray()
        ]);
    }
}