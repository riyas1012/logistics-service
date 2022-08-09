<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        return view('pages.index',[
            'storage_types' => $this->getStorageTypes(),
            'goods_preparation_types' => $this->getGoodsPreparationTypes()
        ]);
    }
}
