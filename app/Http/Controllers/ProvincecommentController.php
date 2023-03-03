<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Touristattraction;
use App\Models\Provincecomment;
use Illuminate\Support\Facades\Redirect;

class ProvincecommentController extends Controller
{
    public function SetComment(Request $request)
	{
		$request->validate([
			'province' => 'required',
			'message' => 'required',
		]);
		$user = Auth::user();
		Provincecomment::Create([
			"user_id" => $user->id,
			"province_id" => $request->province,
			"message" => $request->message,
		]);
        return redirect()->route('ShowProvince', ["province" => $request->province]);

	}
    public  function DeleteComment(Provincecomment $provincecomment)
	{
		$user = Auth::user(); 	
		if ($user->role == "admin") {
			$deleted = DB::table('provincecomments')->where('id', $provincecomment->id)->delete();
			return redirect()->route('ShowProvince', ["province" => $provincecomment->province_id]);
		}
	}

}
