<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('verified');
    }

    public function index(){
      return view('users.index');
    }

}
