<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehouseStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse_storages', function (Blueprint $table) {
            $table->id();
            $table->string('description_of_materials');
            $table->bigInteger('storage_type_id')->unsigned();
            $table->string('quantity_of_items');
            $table->integer('no_of_packaged_goods');
            $table->string('packaging_specifications');
            $table->string('weight_of_goods');
            $table->date('storage_start_date');
            $table->date('storage_end_date');
            $table->enum('any_dangerous',['Yes','No'])->default('No');
            $table->string('dangerous_details')->nullable();
            $table->enum('dissolution_plan_place',['Yes','No'])->default('No');
            $table->string('dissolution_plan_details')->nullable();
            $table->enum('special_handling_requirements',['Yes','No'])->default('No');
            $table->string('special_handling_details')->nullable();
            $table->enum('transport_to_deliver',['Yes','No'])->default('No');
            $table->string('transport_to_deliver_details')->nullable();
            $table->date('date_of_collection')->nullable();
            $table->string('location_of_collection')->nullable();
            $table->string('collection_contact_person')->nullable();
            $table->enum('venues_distribution',['Yes','No'])->default('No');
            $table->timestamps();
            $table->foreign('storage_type_id')->references('id')->on('storage_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse_storages');
    }
}
