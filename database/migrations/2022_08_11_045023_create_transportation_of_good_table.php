<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportationOfGoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportation_of_goods', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('user_service_request_id')->unsigned();
            $table->string('description_of_materials');
            $table->bigInteger('goods_preparation_type_id')->unsigned();
            $table->integer('no_of_packaged_goods');
            $table->string('packaging_specifications');
            $table->string('weight_of_goods');
            $table->dateTime('collection_dttm');
            $table->string('collection_location');
            $table->string('collection_contact_name');
            $table->string('collection_contact_number');
            $table->dateTime('delivery_dttm');
            $table->string('delivery_location');
            $table->string('delivery_contact_name');
            $table->string('delivery_contact_number');
            $table->enum('any_dangerous',['Yes','No'])->default('No');
            $table->string('dangerous_details')->nullable();
            $table->enum('special_handling_requirements',['Yes','No'])->default('No');
            $table->string('special_handling_details')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_service_request_id')->references('id')->on('user_service_requests')->onDelete('cascade');
            $table->foreign('goods_preparation_type_id')->references('id')->on('goods_preparation_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transportation_of_goods');
    }
}
