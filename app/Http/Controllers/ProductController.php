<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ViewProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($categorySlug = null, Request $request)
    {
        //

        $conds = [];
        $cateID = null;
        $selectedCategoryName = "Tất cả sản phẩm";

        if($categorySlug) {
            $tmp = explode("-", $categorySlug);
            $cateID = array_pop($tmp);
            $conds[] =["category_id", "=", $cateID];
            $category = Category::find($cateID);
            $selectedCategoryName = $category->name;
        }

        if($request->has("price-range")) {
            //price-range = 0-100000
            $priceRange = $request->input("price-range");
            $temp = explode("-", $priceRange);
            $start = $temp[0];
            $end = $temp[1];
            $conds[] = ["sale_price", ">=", $start];
            if(is_numeric($end)) {
                $conds[] = ["sale_price", "<=", $end];
            }
        }

        $col = "name";
        $sortType = "ASC";
        if($request->has("sort")) {
            // sort = alpha-asc
            $sort = $request->input("sort");
            $colMap = ['alpha' => 'name', 'created' => 'created_date', 'price' => 'sale_price'];
            $temp = explode("-", $sort);
            $col = $colMap[$temp[0]];
            $sortType = $temp[1];
        }

        if($request->has("search")) {
            // search = Kem
            $search = $request->input("search");
           $conds[] = ["name", "LIKE", "%$search%"];
        }

        $itemPerPage = env("ITEM_PER_PAGE", 6);

        $products = ViewProduct::where($conds)->orderBy($col, $sortType)->paginate($itemPerPage)->withQueryString();

        $categories = Category::all();
        
        $data = [
            "products" => $products,
            "categories" => $categories,
            "cateID" => $cateID,
            "selectedCategoryName" => $selectedCategoryName,
        ];
        return view('product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $tmp = explode("-", $slug);
        $id = array_pop($tmp);
        $product = ViewProduct::find($id);
        $categories = Category::all();
        $data = [
            "product" => $product, 
            "categories" => $categories,
            "cateID" => $product->category_id,
        ];
        return view('product.show', $data);
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

    function search(Request $request) {
        $search = $request->input("pattern");
        $conds = [];
        $conds[] = ["name", "LIKE", "%$search%"];
        $products = ViewProduct::where($conds)->get();
        return view('product.search', ["products" => $products]);
    }
}