<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /** @var App\Elastic\Elastic */
    private $client;

    public function __construct()
    {
        $this->client = app(\App\Elastic\Elastic::class)->getClient();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address');
            $table->timestamps();
        });

        $this->client->indices()->create([
            'index' => 'default',
            'body' => [
                'mappings' => [
                    'address' => [
                        'properties' => [
                            'id' => [
                                'type' => 'integer',
                            ],
                            'address' => [
                                'type' => 'string',
                            ],
                            'updated_at' => [
                                'type' => 'date',
                                'format' => 'yyyy-MM-dd HH:mm:ss'
                            ],
                            'created_at' => [
                                'type' => 'date',
                                'format' => 'yyyy-MM-dd HH:mm:ss'
                            ],
                        ]
                    ]
                ]
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addresses');
        $this->client->indices()->delete(['index' => 'default']);
    }
}
