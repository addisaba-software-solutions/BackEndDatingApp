<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\user_model\Comment;
use Validator;
class CommentController extends Controller
{


   public function store(Request $request){
   	$validator = Validator::make($request->all(), [

            'comment' => 'required',
            'user_id' => 'required',            
            'post_id' => 'required',

        ]);
   if ($validator->fails()) {
            return response()->json (['error'=>$validator->errors()]);
        }

        $input = $request->all();
    
       Comment::create($input);

     return response()->json (["success"=>"true"]);
   }

    public function getComment(Request $request){  

    $blogcomments = Comment::where('post_id', $request->get('post_id'))->get;
     return response()->json ($posts);
}
   
    public function getCommentCount(Request $request){  

    $comments = Comment::where('post_id', $request->get('post_id'))->count();
     return response()->json ($comments);
}

}
