<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserServiceRequest extends Model
{
    use HasFactory;

    protected $table ='user_service_requests';

    public function warehouse_storage(){
       return $this->hasOne(WarehouseStorage::class);
    }

    public function transportation_of_goods(){
        return $this->hasOne(TransportationOfGoods::class);
    }
}
