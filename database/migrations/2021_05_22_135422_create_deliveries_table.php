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
            $table->foreignId('rider_id')->nullable()->constrained();
            $table->foreignId('service_request_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('address');
            $table->enum('cash_on_delivery', ['yes', 'no']);
            $table->enum('status', ['waiting_rider', 'delivering','completed','failed']);
            $table->timestamps();
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
