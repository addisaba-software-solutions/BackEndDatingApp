<?php
namespace App\Http\Controllers\user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class FormValidationController extends Controller
{
    function firstForm(Request $request){
         $validator = Validator::make($request->all(), [
            'gender' => 'required',
            'looking_for' => 'required',            

        ]);
         if ($validator->fails()) {
            return response()->json (['error'=>$validator->errors()]);
        }
    }
    function secondForm(Request $request){

    	$validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|unique:client_users',
        ]);
if ($validator->fails()) {
            return response()->json (['error'=>$validator->errors()]);
        }  

if ($request->hasfile('image')) {
        $image = $request->file('image');
        $filename = $request->get('email').time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('images/') . $filename;
       $path=$request->file('image')->storeAs('public',$filename );
          
           return response()->json (['fileName'=>$filename]);
       
      }     
    }    

 function fourthForm(Request $request){
    	$validator = Validator::make($request->all(), [
            'live' => 'required',
            'firstName' => 'required',    
            'lastName' => 'required',            
            'birthday' => 'required',
            'phone' => 'required|unique:client_users',            
            'live' => 'required',
            'password' => 'required', 
            'password' => 'required',
            'confirm_password' => 'required',
        ]);
if ($validator->fails()) {
            return response()->json (['error'=>$validator->errors()]);
        }
    }

    

}
