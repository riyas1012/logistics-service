<?php

namespace App\Http\Controllers;

use App\Models\GoodsPreparationType;
use App\Models\StorageType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getStorageTypes(){
        return StorageType::where('status',1)->get();
    }

    public function getGoodsPreparationTypes(){
        return GoodsPreparationType::where('status',1)->get();
    }
}
