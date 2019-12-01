<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\user_model\Like;
use Validator;

class LikeController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'post_id' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $liked = Like::where('user_id', $request->get('user_id'))
            ->where('post_id', $request->get('post_id'));
        $likedCount = count($liked->get());

        if ($likedCount > 0) {
            $liked->delete();
        } else {
            $like = new Like();
            $like->user_id = $request->get('user_id');
            $like->post_id = $request->get('post_id');
            $like->is_liked = true;
            $like->save();
        }





        return response()->json(["success" => "true"]);
    }

    public function delete(Request $request)
    {
        $blogcomments = Like::where('post_id', $request->get('post_id'))->get;
        return response()->json($posts);
    }
}
