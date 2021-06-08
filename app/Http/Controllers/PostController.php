<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */

    public function getPosts (Request  $request) {
       $perPage = $request->perPage;
       return Post::paginate($perPage);
   }

    /**
     * @param $id
     * @return mixed
     */
   public function getPostById ($id) {
       return Post::find($id);
   }

   public function createPost (Request $request) {
       return Post::firstOrCreate([
           'user_id' => $request->id,
           'title' => $request->title,
           'description' => $request->description,
           'image' => $request->image,
           'slug' => $request->title,
           'like' => rand(0, 50)
       ]);
   }

   public function likePost (Request $request) {
       return Post::where('id', '=', $request->id)->update(['like' => $request->like]);
   }

}
