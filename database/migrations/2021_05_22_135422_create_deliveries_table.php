<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rider_id');
            $table->foreignId('request_id')->constrained('service_requests');
            $table->string('address');
            $table->enum('cash_on_delivery', ['yes', 'no']);
            $table->enum('status', ['waiting_rider', 'delivering','completed','failed']);
            $table->timestamps();

            $table->foreign('rider_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
