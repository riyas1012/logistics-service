<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountActivationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $className = 'AccountActivationSeeder';
        if(DB::table('seeding')->where('name',$className)->count() == 0){
            $notActivatedUser = User::where('is_activated','!=',1)->get();
            foreach ($notActivatedUser as $user) {
                User::where('id',$user->id)->update(array(
                    'is_activated' => 1,
                    'activation_code' => $this->generateRandomKey(24)
                ));
            }
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

    public function generateRandomKey($length = 32)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }
}
