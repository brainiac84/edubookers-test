<?php

namespace App;

use App\Elastic\Elastic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Address extends Model
{
    protected $fillable = ['address'];

    private function searchOnElasticsearch()
    {
        $elastic = app(Elastic::class);

        $items = $elastic->search([
            'index' => 'default',
            'type' => 'address',
            'body' => [
                'query' => [
                    'match_all' => []
                ]
            ]
        ]);

        return $items;
    }

    public static function fetchAllFromElastic()
    {
        $self = new static();

        $items = $self->searchOnElasticsearch();

        return $self->buildCollection($items);
    }

    private function buildCollection($items)
    {
        $result = $items['hits']['hits'];

        return Collection::make(array_map(function ($r) {

            $address = new Address();
            $address->newInstance($r['_source'], true);
            $address->setRawAttributes($r['_source'], true);

            return $address;

        }, $result));
    }

}
