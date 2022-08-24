<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsWarehouseStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouse_storages', function (Blueprint $table) {
            $table->string('collection_contact_number')->nullable()->after('collection_contact_person');
            $table->string('venues_distribution_contact_number')->nullable()->after('venues_distribution_place');
            $table->dateTime('expected_delivetr_dttm')->nullable()->after('transport_to_deliver_details');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse_storages', function (Blueprint $table) {
            //
        });
    }
}
