<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Ward;
use App\Models\Province;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    function show() {
        $data = [];
        return view('customer.show',$data);
    }

    function update(Request $request) {
        // dd($request->all());
        $customer = Auth()->user();
        $customer->name = $request->input("fullname");
        $customer->mobile = $request->input("mobile");
        if($request->input("password") && $request->input("old_password")) {
            if(!Hash::check($request->input("old_password"), $customer->password)) {
                session()->put("error", "Mật khẩu hiện tại không đúng!");
                return redirect()->route("customer.show");
            }
            //update password
            $customer->password = Hash::make($request->input("password"));
        }
        $customer->save();
        session()->put('success', "Cập nhật thông tin tài khoản thành công!");
        return redirect()->route("customer.show");
    }

    function address() {
        // $data = [];
        $customer = Auth()->user();
        $districts = [];
        $wards = [];
        $selected_ward = $customer->ward;
        $selected_province_id = null;
        $selected_district_id = null;
        $selected_ward_id = null;
        $shipping_fee = 0;
        if (!empty($selected_ward)) {
            $selected_ward_id = $selected_ward->id;// 2 selected_ward_id
            $selected_district = $selected_ward->district;
            $selected_district_id = $selected_district->id;//3 selected_district_id
            $selected_province = $selected_district->province;
            $selected_province_id = $selected_province->id; //4 selected_province_id
            $districts = $selected_province->districts; // 5 districts
            $wards =  $selected_district->wards; //6 wards
            $shipping_fee = Transport::where("province_id", $selected_province_id)->first()->price;

        }

        $provinces = Province::all();
        $data = [
            "customer" => $customer,
            "provinces" => $provinces,
            "districts" => $districts,
            "wards" => $wards,
            "selected_province_id" => $selected_province_id,
            "selected_district_id" => $selected_district_id,
            "selected_ward_id" => $selected_ward_id,
            "shipping_fee" => $shipping_fee,
        ];
        return view('customer.address',$data);
    }

    function updateAddress(Request $request) {
        // var_dump($_POST);
        $customer = Auth()->user();
        $customer->shipping_name = $_POST["fullname"];
        $customer->shipping_mobile = $_POST["mobile"];
        $customer->ward_id = $_POST["ward"];
        $customer->housenumber_street = $_POST["address"];
        $customer->save();
        session()->put('success', "Cập nhật thông tin giao hàng thành công!");
        return redirect()->route("customer.address");
    }
}