<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairingServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairing_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('service_requests')->onDelete('cascade');
            $table->enum('status', ['pending', 'on_progress', 'repaired','cannot_be_repaired']);
            $table->float('cost');
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
        Schema::dropIfExists('repairing_services');
    }
}
