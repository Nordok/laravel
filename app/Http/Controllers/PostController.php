<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @return Post[]|\Illuminate\Database\Eloquent\Collection
     */

    public function getPosts () {
       return Post::all();
   }
}
