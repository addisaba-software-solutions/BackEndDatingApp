<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\user_model\Post;
use App\user_model\Client_user;
use Image;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public $user;


    public function index(Request $request)
    {
        // $posts = Client_user::join('posts', 'posts.user_id', '=', 'client_users.email')
        //                     ->select('posts.id','posts.user_id','posts.title','posts.body','posts.created_at','posts.image',
        //                 'client_users.firstName','client_users.lastName','client_users.email')->orderBy('posts.created_at', 'DESC')
        //        ->get();
        // ->select('posts.user_id','posts.id','posts.title','posts.body','client_users.email','client_users.firstName','client_users.lastName')
        //  Auth::user()->posts()->latest()->get();
        $posts = Post::with(['client_users', 'likes', 'comments', 'shares'])
            ->withCount('comments', 'likes', 'shares')
            ->orderBy("posts.created_at", "desc")->get();


        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable',
            'body' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id' => 'required',
            'firstName' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $post = new Post();

        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->user_id = $request->get('user_id');


        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $filename = $request->get('firstName') . $request->get('id') . time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/') . $filename;
            // Image::make($image)->save($location);

            $path = $request->file('image')->storeAs('public', $filename);

            $post->image = $filename;
        }

        $post->save();

        return response()->json(["success" => "true"]);
    }

    function deletePost($id)
    {
        Post::Find($id)->delete();

    }
}
