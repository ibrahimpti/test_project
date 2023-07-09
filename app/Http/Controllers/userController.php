<?php

namespace App\Http\Controllers;
use App\Models\post;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function index()
    {
        $posts = post::all();
        return view('/components.home', ['posts' => $posts]);
    }
    public function store(Request $request)
    {
        $x=$request->validate(
            ['name'=>'required',
                'email'=>'nullable|email']
        );

            $post = new post();
            $post->name = $x['name'];
            $post->email = $x['email'];
           if($post->save()) {
               return redirect()->back()->with('success', 'Post created successfully');
           }
           else{
               return redirect()->back()->with('error', 'Post not found');

           }
        }

    public function destroy($id)
    {
        $post = post::find($id);

        if ($post) {
            $post->delete();
            return redirect()->back()->with('success', 'Post deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Post not found');
        }
    }

    public function edit($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        return view('components.update', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }

        $post->name = $request->input('uname');
        $post->email = $request->input('uemail');
        $post->save();

        return redirect('/home')->with('success', 'Post updated successfully');
    }




}
