<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Ward;
use App\Models\Province;
use App\Models\Transport;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth()->check()) {
            $customer = Auth()->user();
        }
        else {
            $guest = env("GUEST");
            $customer = Customer::where("email", $guest)->first();
        }

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
        return view('payment.checkout',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $order = new Order();
        
        $order->created_date = date("Y-m-d H:i:s");
        $order->order_status_id = 1;
        $order->customer_id = Auth()->user()->id;
        $order->shipping_fullname = $_POST['fullname'];
        $order->shipping_mobile = $_POST['mobile'];
        $order->payment_method = $_POST['payment_method'];
        $order->shipping_ward_id = $_POST['ward'];
        $order->shipping_housenumber_street = $_POST['address'];

        $province_id = Ward::find($order->shipping_ward_id)->district->province->id;
        $order->shipping_fee = Transport::where("province_id", $province_id)->first()->price;

        $order->delivered_date = date("Y-m-d H:i:s", strtotime("+3 days"));
        $order->price_total = Cart::priceTotal(0,"","");
        $order->discount_code = session()->get("discount_code");
        $order->discount_amount = Cart::discount(0,"","");//update later
        $order->sub_total = Cart::subTotal(0,"","");
        // $order->discount_amount = $order->price_total - $order->sub_total;
        $order->tax = Cart::tax(0,"","");
        $order->price_inc_tax_total = Cart::total(0,"","");
        $order->payment_total = $order->shipping_fee + Cart::total(0,"","");
        $order->save();
        $order_id = $order->id;
        foreach(Cart::content() as $item) {
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order_id;
            $orderItem->qty = $item->qty;
            $orderItem->unit_price = $item->price;
            $orderItem->total_price = $item->qty * $item->price;
            $orderItem->save();
        }
        session()->put("success", "Done");
        return redirect()->route("product.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}