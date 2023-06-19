<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Ward;
use App\Models\District;
use App\Models\Transport;
use Illuminate\Http\Request;


class OrderController extends Controller
{

    function index() {
        return view('order.index', []);
    }

    function show($orderId) {

    }
}