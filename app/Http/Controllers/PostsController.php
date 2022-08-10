<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    //
    public function index()
    {
        $posts = Post::get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        if ($validator->fails()){
            return $this->create()
                ->withErrors($validator);
        }
        $post = new Post();
        $post -> title = $request->title;
        $post ->body = $request -> body;

        $post-> save();
        return redirect('/posts');
    }

    public function edit($id)
    {
        //
        $post = Post::find($id);
        return view('posts.edit',compact('post'));
    }

    public function update(Request $request , $id){
        $request->validate([
            'title' =>  'required|max:200',
            'body' => 'required|max:500',
        ]);
        $post = Post:: find ($id);

        $post -> title = $request-> title;
        $post -> body  = $request-> body;
        $post->save();

        return redirect('/posts/');

    }


    public function destroy($id)
    {
        //
        $post = Post::find ($id);
        $post-> delete();
        return redirect('/posts');
    }


}
