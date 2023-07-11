<?php

namespace App\Http\Controllers;
use App\Models\post;
use Illuminate\Http\Request;
use App\Models\admin;

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

    public function storer(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $admin = new admin();
        $admin->name = $validatedData['name'];
        $admin->password = $validatedData['password'];

        if ($admin->save()) {
            return redirect()->route('login')->with('success', 'Registration successful');
        } else {
            return redirect()->back()->with('error', 'Failed to register');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user' => 'required',
            'password' => 'required'
        ]);

        $admin = admin::where('name', $credentials['user'])->first();

        if ($admin && password_verify($credentials['password'], $admin->password)) {
            // Authentication successful
            return redirect()->route('home')->with('success', 'Logged in successfully');

        } else {
            // Invalid credentials
            return redirect()->back()->with('error', 'Invalid login credentials');
        }
    }




}
