<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGoodsPrepareTypeWarehouseStorages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouse_storages', function (Blueprint $table) {
            $table->bigInteger('goods_preparation_type_id')->unsigned()->after('quantity_of_items');
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
        Schema::table('warehouse_storages', function (Blueprint $table) {
            //
        });
    }
}
