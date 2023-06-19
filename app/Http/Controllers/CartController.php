<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Discount;
use App\Models\ViewProduct;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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
    public function create($product_id, $qty)
    {
        //
        $this->restoreFromDb();
        $product = ViewProduct::find($product_id);
        Cart::add(['id' => $product_id, 'name' => $product->name, 'qty' => $qty, 'price' => $product->sale_price, 'weight' => 0, 'options' => ['image' => $product->featured_image]]);
        $this->storeIntoDb();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        //
        $product_id = $request->input("product_id");
        $qty = $request->input("qty");
        $this->create($product_id, $qty);

        //store into database
        $this->display();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // $cart = Cart::content();
        // $this->storeIntoDb();
        // $this->restoreFromDb();
        // var_dump($cart);
        Cart::setGlobalDiscount(20);
        
    }

    protected function display() {
        //return JSON
        $result = [];
        $result["count"] = Cart::count();
        $result["subtotal"] = Cart::subtotal();
        $result["items"] = view("layout.cartitem")->render();
        echo json_encode($result);
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
    public function update($rowId, $qty)
    {
        //
        $this->restoreFromDb();
        Cart::update($rowId, $qty);
        $this->storeIntoDb();
        $this->display();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
        Cart::destroy();
    }

    public function delete($rowId) {
        $this->restoreFromDb();
        Cart::remove($rowId);
        $this->storeIntoDb();
        $this->display();
    }

    protected function storeIntoDb() {
        if(Auth()->check()) {
            $emailLogin = Auth()->user()->email;
            Cart::store($emailLogin);
        }
    }

    protected function restoreFromDb() {
        if (Auth()->check()) {
            $emailLogin = Auth()->user()->email;
            Cart::restore($emailLogin);
        }

    }

    function discount(Request $request) {
        $discount_code = $request->input("discount-code");
        //lookup data to get % discount
        //do later
        $discount = Discount::where("code", $discount_code)->first();
        if ($discount) {
            $discount_amount = $discount->discount_amount;
            $this->restoreFromDb();
            Cart::setGlobalDiscount($discount_amount);
            $this->storeIntoDb();
            $request->session()->forget("error_discount_code");
        }
        else {
            $this->restoreFromDb();
            Cart::setGlobalDiscount(0);
            $this->storeIntoDb();
            $request->session()->put("error_discount_code", "Mã giảm giá không hợp lệ");
        }
        $request->session()->put("discount_code", $discount_code);
        return redirect()->route("payment.create");
    }
}