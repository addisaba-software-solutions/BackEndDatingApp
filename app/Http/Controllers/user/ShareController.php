<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\user_model\Share;
use App\user_model\Post;
use Validator;
class ShareController extends Controller
{
  public function store(Request $request){
          $validator = Validator::make($request->all(), [
            'post_id' => 'required',
            'logged_user' => 'required',  
        ]);
        
     if ($validator->fails()) {
            return response()->json (['error'=>$validator->errors()]);
        }

       $share=new Share();
       $share->post_id=$request->get('post_id');       
       $share->user_id=$request->get('logged_user'); 
       $share->save();
      
       $post = Post::find($request->get('post_id'));
        $post->shared=1;  
        $post->shared_from=$post->user_id;
        $post->user_id=$request->get('logged_user');
        
       $new = $post->replicate()->save();

      return response()->json (['success'=>$new]);
  }  
}
