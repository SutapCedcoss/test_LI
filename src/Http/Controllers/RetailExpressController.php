<?php

namespace LightningIllusion\RetailExpress\Http\Controllers;

;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class RetailExpressController extends Controller
{
    public function index()
    {
        return view('retailExpress::retailExpress');
    }

    public function send(Request $request)
    {
        dd($request->all());
        return view('retailExpress::retailExpress');
    }
}
