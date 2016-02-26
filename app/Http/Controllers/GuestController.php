<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Routing\UrlGenerator;

use App\Account;

class GuestController extends Controller
{
    public function index(){
    	return view('home', ['pending_accounts' => Account::where('status', 'On Review')->get()]);
    }
}
