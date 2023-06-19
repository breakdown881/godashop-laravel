<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Ward;
use App\Models\District;
use App\Models\Transport;
use Illuminate\Http\Request;


class AddressController extends Controller
{
    function districts($province_id) {

        $province = Province::find($province_id);
        $districts = $province->districts;
        $arr = [];
        foreach ($districts as $district) {
            $arr[] = ["id" => $district->id, "name" => $district->name];
        }
        echo json_encode($arr);
    }

    function wards($district_id) {

        $district = District::find($district_id);
        $wards = $district->wards;
        $arr = [];
        foreach ($wards as $ward) {
            $arr[] = ["id" => $ward->id, "name" => $ward->name];
        }
        echo json_encode($arr);
    }

    function shippingFee($province_id) {
        echo Transport::where("province_id", $province_id)->first()->price;;
    }
}