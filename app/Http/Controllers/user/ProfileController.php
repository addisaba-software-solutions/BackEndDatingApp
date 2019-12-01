<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\user_model\Client_user;
use App\user_model\ProfileLike;
use App\user_model\ProfileLove;
use App\user_model\ProfileSuperLove;
use App\user_model\ProfileVisited;
use Illuminate\Support\Facades\DB;
use Validator;

class ProfileController extends Controller
{

// =================================================================================
    function profile(Request $request)
    {
        $profile = Client_user::with(['profileLikes', 'profileLoves', 'profileVisited', 'profileSuperLoves'])
            ->withCount('profileLikes', 'profileLoves', 'profileVisited', 'profileSuperLoves')
            ->where('email', $request->get('email'))
            ->get();

        return response()->json(['success' => $profile]);
    }

    // =================================================================================

    function likeStore(Request $request)
    {

        $liked = ProfileLike::where('liker', $request->get('liker'))
            ->where('liked', $request->get('liked'));
        $likedCount = count($liked->get());
        if ($likedCount > 0) {
            $liked->delete();
        } else {
            $like = new ProfileLike();
            $like->liker = $request->get('liker');
            $like->liked = $request->get('liked');
            $like->save();
        }
    }

    // =================================================================================


    public function loveStore(Request $request)
    {

        $loved = ProfileLove::where('lover', $request->get('lover'))
            ->where('loved', $request->get('loved'));
        $lovedCount = count($loved->get());

        if ($lovedCount > 0) {
            $loved->delete();
        } else {
            $love = new ProfileLove();
            $love->lover = $request->get('lover');
            $love->loved = $request->get('loved');
            $love->save();
        }
    }

    // =================================================================================

    public function superLoveStore(Request $request)
    {

        $loved = ProfileSuperLove::where('super_lover', $request->get('super_lover'))
            ->where('super_loved', $request->get('super_loved'));
        $lovedCount = count($loved->get());

        if ($lovedCount > 0) {
            $loved->delete();
        } else {
            $love = new ProfileSuperLove();
            $love->super_lover = $request->get('super_lover');
            $love->super_loved = $request->get('super_loved');
            $love->save();
        }
    }

    // =================================================================================

    public function visitedStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'visited' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        if ($request->get('visited') != null) {
            $visited = new ProfileVisited();
            $visited->visited = $request->get('visited');

            $visited->save();
        }
    }
    // =================================================================================

    public function exprore(Request $request)
    { }
}
