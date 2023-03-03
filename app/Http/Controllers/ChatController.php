<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Chat;
use App\Models\User;
use App\Models\Guideperson;
use Verta;

class ChatController extends Controller
{
    public function ShowChat(User $user)
	{
		$auth_user = Auth::user();
        if ($auth_user)
         {
        if($user->role == "guide")
        {
            $guideperson = Guideperson::all()->where('user_id', $user->id)->first();
            $real_user = $auth_user;

        }
        elseif($auth_user->role == "guide")
        {
            $guideperson = Guideperson::all()->where('user_id', $auth_user->id)->first();
            $real_user = $user;
        }
        
            $flag1 = DB::table('guideperson_user')
            ->where('guideperson_id', $guideperson->id)
            ->where('user_id', $real_user->id)
            ->get();

            $chats = DB::table('chats')
            ->where('guideperson_id', $guideperson->id)
            ->where('user_id', $real_user->id)
            ->get(); 
            
            
            return view('chat.show', ["chats" => $chats, "user" => $real_user, "guideperson" => $guideperson , "contact"=> $user]);
         }
    }
    public function SendMessage(Request $request)
	{
        //flag = 0 message from guide
        //flag = 1 message from user

		$request->validate([
			'contact' => 'required',
			'message' => 'required',
		]);
		$auth_user = Auth::user();
        
        if($auth_user->role == "user")
        {
            $guideperson = Guideperson::all()->where('user_id', $request->contact)->first();
            $real_user = $auth_user;
            $flag = 1;

        }
        elseif($auth_user->role == "guide")
        {
            $guideperson = Guideperson::all()->where('user_id', $auth_user->id)->first();
            $real_user = User::find($request->contact);
            $flag = 0;
        }

		Chat::Create([
			"user_id" => $real_user->id,
			"guideperson_id" => $guideperson->id,
			"flag" => $flag,
			"message" => $request->message,
		]);
			return redirect()->route('ShowChat', ["user" => $request->contact]);
	}

}
