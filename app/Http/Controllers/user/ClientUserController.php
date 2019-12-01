<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\user_model\Client_user;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Message;
use Pusher\Pusher;
use App\Events\sendMessageEvent;
use App\Events\EventsTypingIndicator;
use App\Events\MessageCountEvent;
use Illuminate\Support\Facades\DB;

class ClientUserController extends Controller
{
    public $successStatus = 200;
    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        if (Auth::attempt(['email' => $request->input('email'), 'password' =>  $request->input('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['id'] =  $user->id;
            $success['firstName'] =  $user->firstName;
            $success['lastName'] =  $user->lastName;
            $success['email'] =  $user->email;
            $success['aboutMe'] =  $user->aboutMe;
            $success['phone'] =  $user->phone;
            $success['live'] =  $user->live;
            $success['birthday'] =  $user->birthday;
            // $success['password'] =  $user->password;
            $success['image'] =  $user->image;
            $success['hobby'] =  $user->hobby;


            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => ['unauthorised' => 'Sorry! You are Unauthorised to login ']]);
        }
    }

    // =================================================================================

    function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:client_users',
            'image' => 'required',
            'phone' => 'required|unique:client_users',
            'live' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'relationShip' => 'required',
            // 'status' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',

            'pet' => 'required',
            'flock' => 'required',
            'kickMyDay' => 'required',
            'myFridge' => 'required',
            'phoneUsage' => 'required',
            'afterLongDay' => 'required',
            'food' => 'required',
            'goingOut' => 'required',
            'life' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $user = new Client_user();
        $user->gender = $request->get('gender');
        $user->relationShip = $request->get('relationShip');

        $user->firstName = $request->get('firstName');
        $user->lastName = $request->get('lastName');
        $user->email = $request->get('email');
        $user->image = $request->get('image');
        $user->phone = $request->get('phone');
        $user->live = $request->get('live');
        $user->birthday = $request->get('birthday');
        $user->password = bcrypt($request->get('password'));

        $user->pet = $request->get('pet');
        $user->flock = $request->get('flock');
        $user->kickMyDay = $request->get('kickMyDay');
        $user->myFridge = $request->get('myFridge');
        $user->phoneUsage = $request->get('phoneUsage');
        $user->afterLongDay = $request->get('afterLongDay');
        $user->food = $request->get('food');
        $user->goingOut = $request->get('goingOut');
        $user->life = $request->get('life');
        $user->save();
        return response()->json(['success' => "true"]);
    }

    // =================================================================================

    function getUser(Request $request)
    {
        $users = DB::select("select client_users.id,
        client_users.firstName,
        client_users.lastName,
        client_users.image,
        client_users.email,
        client_users.aboutMe,

        count(is_read) as unread
        from client_users LEFT  JOIN  messages ON client_users.email= messages.from and is_read = 0 and messages.to = '" . $request->get('logged_user') . "'
        where client_users.email != '" . $request->get('logged_user') . "'
        group by client_users.id, client_users.firstName, client_users.lastName, client_users.email order by 'messages.updated_at' desc ");

        return response()->json($users);
    }

    // =================================================================================

    function getUserDetail(Request $request)
    {
        $my_id = $request->get('sender_id');
        $user_id = $request->get('receiver_id');

        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();
        $users = User::where('id', '!=', $user_id)->get();

        return response()->json([$users->toArray(), $messages->toArray()]);
    }

    // =================================================================================


    function getMessage(Request $request)
    {
        $sender_id = $request->get('sender_id');
        $user_id = $request->get('receiver_id');
        Message::where(['from' => $user_id, 'to' => $sender_id])->update(['is_read' => 1]);

        $messages = Message::where(function ($query) use ($user_id, $sender_id) {
            $query->where('from', $user_id)->where('to', $sender_id);
        })->oRwhere(function ($query) use ($user_id, $sender_id) {
            $query->where('from', $sender_id)->where('to', $user_id);
        })->get();


        return response()->json($messages);
    }

    // =================================================================================

    function sendMessage(Request $request)
    {
        $from = $request->get('sender_id');
        $to = $request->get('receiver_id');
        $message = $request->get('message');
        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->image = $request->get('image');;

        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        $msgCounter = DB::select("select count(is_read) as unread from messages where messages.from='" . $from . "' and messages.to='" . $to . "' and is_read=0");

        event(new sendMessageEvent($from, $to, $message, $msgCounter));

        return response()->json(['succces' => $msgCounter]);
    }

    // =================================================================================

    function message(Request $request)
    {
        event(new EventsTypingIndicator($request->get('typing'), $request->get('sender_id'), $request->get('reciever_id')));
    }
    // =================================================================================

    function getMessageCounter()
    {
        $msgCounter = DB::select("select * from messages where is_read=0");
        // event(new MessageCounterEvent( $msgCounter.from,$msgCounter.to,$msgCounter.count));
        return response()->json($msgCounter);
    }
    // =================================================================================
    function addAboutMe($id)
    {

        $user = Client_user::find($id);

        $user->aboutMe = request('aboutMe');
        $user->save();
        return response()->json(['success' => "true"]);
    }

    // =================================================================================

    function addHobby($id)
    {
        $user = Client_user::find($id);

        $user->hobby = request('hobby');
        $user->save();
        return response()->json(['success' => "true"]);
    }

    // =================================================================================

    function updateUser(Request $request , $id)
    {
        $validator = Validator::make($request -> all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => 'required|unique:client_users',
            'live' => 'required',
            'birthday' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $user = Client_user::find($id);

        $user->firstName = request('firstName');
        $user->lastName = request('lastName');
        $user->phone = request('phone');
        $user->live = request('live');
        $user->birthday = request('birthday');
        $user->password = bcrypt(request('password'));
        $user->save();
        return response()->json(['success' => "true"]);
    }

    // =================================================================================

    function getOneUSer($id) {
        $user = Client_user::find($id);

        // $user->firstName = request('firstName');
        // $user->lastName = request('lastName');
        // $user->email = request('email');
        // $user->image = request('image');
        // $user->phone = request('phone');
        // $user->live = request('live');

        // return response()->json(['success' => "true"]);
        return ($user);

    }

    // =================================================================================

}
