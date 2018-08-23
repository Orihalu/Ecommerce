<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    public function add_to_cart($product) {
      Auth::user()->add_to_cart($product);
      return redirect()->back();
    }
}
