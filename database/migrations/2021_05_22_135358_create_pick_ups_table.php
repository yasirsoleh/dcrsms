<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pick_ups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rider_id');
            $table->foreignId('request_id')->constrained('service_requests');
            $table->string('address');
            $table->enum('status', ['waiting_rider', 'picking_up','completed','failed']);
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
        Schema::dropIfExists('pick_ups');
    }
}
