<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StorageTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $className = 'StorageTypeSeed';
        if(DB::table('seeding')->where('name',$className)->count() == 0){
            $insertArray = array(
                array(
                    'name' => 'Temperature Controlled',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'name' => 'Ambient',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'name' => 'Other',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
            );

            DB::table('storage_types')->insert($insertArray);
            $seedingInsertArray = array(
                array(
                    'name' => $className,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                )
            );
            DB::table('seeding')->insert($seedingInsertArray);
        }
    }
}
