<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WhitelistController extends Controller
{
  function show() 
  {
    return view('frontend.customer.whitelist');
  }
}
