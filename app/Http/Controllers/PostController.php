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

    /**
     * @param $id
     * @return mixed
     */
   public function getPostById ($id) {
       return Post::find($id);
   }

   public function createPost (Request $request, $id) {
       return Post::firstOrCreate([
           'user_id' => $id,
           'title' => $request->title,
           'description' => $request->description,
           'image' => $request->image,
           'slug' => $request->title,
           'like' => rand(0, 50)
       ]);
   }

}
