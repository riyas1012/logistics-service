<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportationOfGoods extends Model
{
    use HasFactory;
    protected $table = 'transportation_of_goods';

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function user_service_request(){
        return $this->belongsTo(UserServiceRequest::class);
    }
}
