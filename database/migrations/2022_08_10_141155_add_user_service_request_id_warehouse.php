<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserServiceRequestIdWarehouse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouse_storages', function (Blueprint $table) {
            $table->bigInteger('user_service_request_id')->unsigned()->after('user_id');
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
        Schema::table('warehouse_storages', function (Blueprint $table) {
            //
        });
    }
}
