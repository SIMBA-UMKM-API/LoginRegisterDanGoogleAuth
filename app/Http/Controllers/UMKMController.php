<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\UMKM;
use Illuminate\Support\Facades\Hash;

class UMKMController extends Controller
{
    function registerBusiness(Request $req){
        $req->validate([
            'business_name' => 'required|min:3',
            'business_category' => 'required',
            'business_location' => 'required',
            'business_email' => 'required|email'
        ]);
        $umkm = new UMKM();
        $umkm->business_name =$req->input('business_name');
        $umkm->business_category = $req->input('business_category');
        $umkm->business_location = $req->input('business_location');
        $umkm->business_email = $req->input('business_email');
        $result = $umkm->save();

        if($result){
            return ["Result"=>"UMKM successfully registered"];
        }
        else{
            return ["Result"=>"Operation Failed"];
        }
    }
}
