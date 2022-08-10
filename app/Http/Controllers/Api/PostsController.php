<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    use ApiResponseTrait;
    //
    public function index(){

    $post =  PostResource::collection(Post::get());

    return $this->apiResponse($post);

    }
    public function show($id){
        $post =Post::find($id);
        if($post ){
            return $this->apiResponse( new PostResource($post),'ok',200);
        }else{
            return $this->apiResponse(null,'this post not found',404);
        }
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null,$validator->errors(),400);
        }else{
            $post = new Post();
            $post -> title = $request->title;
            $post ->body = $request -> body;

            $post-> save();
            return $this->apiResponse( new PostResource($post),'this post saved',201);
        }
    }

    //update function
    public function update(Request $request , $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
            }

            $post = Post::find($id);
            if (!$post){
                return $this->apiResponse( null ,'this post not founded',404);
            }


            $post -> title = $request->title;
            $post ->body = $request -> body;
            $post-> save();
            if ($post){
                return $this->apiResponse( new PostResource($post),'this post updated',201);
            }
    }

    public function destroy($id)
    {
        //
        $post = Post::find ($id);

        return $this->postValidate($post);


    }
}
