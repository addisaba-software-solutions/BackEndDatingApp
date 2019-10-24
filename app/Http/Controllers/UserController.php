<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Message;
use Pusher\Pusher;
use App\Events\SendMessageEvent;
use App\Events\EventsTypingIndicator;
class UserController extends Controller
{
public $successStatus = 200;

    public function getUser(Request $request){

  $users = User::where('id','!=',$request->get('logged_user'))->get();
  return response()->json($users->toArray());

    }
    public function getUserDetail(Request $request){
        $my_id=$request->get('sender_id');
      $user_id=$request->get('receiver_id');

       $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();
    $m=Message::all();
  $users = User::where('id','!=',$user_id)->get();

  return response()->json([$users->toArray(),$messages->toArray()]);

        // select all users except logged in user
        // $users = User::where('id', '!=', Auth::id())->get()->toJson();
        // return response()->json($users->toArray());
    }

  public function login(Request $request){
        if(Auth::attempt(['email' => $request->input('email'), 'password' =>  $request->input('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['id'] =  $user->id;
            $success['firstName'] =  $user->firstName;
            $success['lastName'] =  $user->lastName;
            $success['email'] =  $user->email;
            return response()->json(['success' => $success], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>'Sorry! You are Unauthorised to login '], 401);
        }
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'role' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
if ($validator->fails()) {
            return response()->json (['error'=>$validator->errors()], 401);
        }
         $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['id'] =  $user->id;
        $success['firstName'] =  $user->firstName;
        $success['lastName'] =  $user->lastName;
        $success['email'] =  $user->email;
       return response()->json(['success'=>$success], $this-> successStatus);
    }

    public function details(){
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }

   public function getMessage(Request $request){
    $sender_id=$request->get('sender_id');
    $user_id=$request->get('receiver_id');
     $messages = Message::where(function ($query) use ($user_id, $sender_id) {
            $query->where('from', $user_id)->where('to', $sender_id);
        })->oRwhere(function ($query) use ($user_id, $sender_id) {
            $query->where('from', $sender_id)->where('to', $user_id);
        })->get();


       return response()->json($messages->toArray());


  // return response()->json(['message'=>$request->all()]);
    }
    public function sendMessage(Request $request)
    {
        $from = $request->get('sender_id');//Auth::id();
        $to = $request->get('receiver_id');
        $message =$request->get('message');
        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();
   event(new sendMessageEvent($from,$to,$message));

   // pusher
        // $options = array(
        //     'cluster' => 'ap2',
        //     'useTLS' => true
        // );
        //
        // $pusher = new Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     $options
        // );
        //
        // $data = ['from' => $from, 'to' => $to,'message'=>$message]; // sending from and to user id when pressed enter
        // $pusher->trigger('my-channel', 'my-event', $data);
        return response()->json(['succces'=>"good"]);
    }

public function message(Request $request){
  event(new EventsTypingIndicator($request->get('typing')));
}
}
