<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class StarsController extends Controller
{
      public function __construct()
      {
          $this->middleware('verified');
      }

      public function store(Post $post) {
        auth()->user()->givenStars()->toggle($post);
      }

}
