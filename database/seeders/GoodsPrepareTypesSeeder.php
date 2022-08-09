<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodsPrepareTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $className = 'GoodsPrepareTypesSeeder';
        if(DB::table('seeding')->where('name',$className)->count() == 0){
            $insertArray = array(
                array(
                    'name' => 'Palletised',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'name' => 'Loose Items',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
                array(
                    'name' => 'Boxes',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ),
            );

            DB::table('goods_preparation_types')->insert($insertArray);
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
