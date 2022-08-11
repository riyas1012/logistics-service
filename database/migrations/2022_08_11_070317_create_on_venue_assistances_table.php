<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnVenueAssistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('on_venue_assistances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('user_service_request_id')->unsigned();
            $table->enum('crew_assistance',['Yes','No'])->default('No');
            $table->integer('crew_quantity')->nullable();
            $table->integer('supervisor_quantity')->nullable();
            $table->enum('material_handling_equipment',['Yes','No'])->default('No');
            $table->integer('forklift_quantity')->nullable();
            $table->integer('pallet_jack_quantity')->nullable();
            $table->integer('trolley_quantity')->nullable();
            $table->enum('logistics_assistance_venue',['Yes','No'])->default('No');
            $table->string('logistics_assistance_venue_details')->nullable();
            $table->string('short_breif_activity')->nullable();
            $table->string('location');
            $table->string('contact_name');
            $table->string('contact_number');
            $table->date('start_date');
            $table->string('start_time',25);
            $table->date('end_date');
            $table->string('end_time',25);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_service_request_id')->references('id')->on('user_service_requests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('on_venue_assistances');
    }
}
