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
        $guideperson;
        $real_user;
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
}
