<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVenueDetailsTableWarehouseStorages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouse_storages', function (Blueprint $table) {
            $table->date('venues_distribution_date')->nullable()->after('venues_distribution');
            $table->string('venues_distribution_place')->nullable()->after('venues_distribution_date');
            $table->string('venues_distribution_contact')->nullable()->after('venues_distribution_place');
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
            $table->dropColumn('venues_distribution_date');
            $table->dropColumn('venues_distribution_place');
            $table->dropColumn('venues_distribution_contact');
        });
    }
}
