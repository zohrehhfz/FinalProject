<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Guideperson;
use App\Models\Province;

class UserController extends Controller
{
    public function edit()
	{
		$user = Auth::user();
		$provinces = Province::all();
		return view('panels.edit', ['user' => $user , 'provinces' => $provinces]);
	}  
    public function update(Request $request)
	{
		$user = Auth::user();
		
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'phone' => ['required', 'string', 'min:11', 'max:13'],
			'photo' => ['mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
			'certificate' => ['mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
			'provincename' => ['required','string'],
		]);
		
		$newphotofilename = "null";
		$photofilename = "null";
		if ($request->photo != null) {

			$photofile = $request->file('photo');
			$photofilename = $photofile->getClientOriginalName();
			$extension = $photofile->extension();
			$newphotofilename = sha1(time() . '_' . rand(1000000000, 1999999999) . '_' . rand(1000000000, 1999999999) . '_' . $photofilename);
			$newphotofilename = $newphotofilename . '.' . $extension;

			Storage::disk('local')->putFileAs(
				'public/files',
				$photofile,
				$newphotofilename
			);
			DB::table('users')->where('id', $user->id)->update(array(
				"photoname" => $newphotofilename,
				"orginalphotoname" => $photofilename,
			));
		}
        $guide = 0;
		$newcertificatefilename = "null";
		$certificatefilename = "null";
		
		if ($request->certificate != null) {
            $guide = 1;
			$certificatefile = $request->file('certificate');
			$certificatefilename = $certificatefile->getClientOriginalName();
			$extension = $certificatefile->extension();
			$newcertificatefilename = sha1(time() . '_' . rand(1000000000, 1999999999) . '_' . rand(1000000000, 1999999999) . '_' . $photofilename);
			$newcertificatefilename = $newcertificatefilename . '.' . $extension;

			Storage::disk('local')->putFileAs(
				'public/certificates',
				$certificatefile,
				$newcertificatefilename
			);
           
			if($user->guidepersons()->count() == 0)
			{
				Guideperson::create([
					'user_id' => $user->id,
					'certificatename' => NULL , 
					'orginalcertificatename' => NULL
				]);
			}
			DB::table('guidepersons')->where('user_id', $user->id)->update(array(
				"certificatename" => $newcertificatefilename,
				"orginalcertificatename" => $certificatefilename,
			));
		}
		
		$p = Province::all()->where('name', $request->provincename)->pluck('id');

		DB::table('users')->where('id', $user->id)->update(array(
			'name' => $request->name,
			'email' => $request->email,
			'phone' => $request->phone,
			'province_id' => $p[0],
			'bio' => $request->bio,
		));
		$user = User::find(Auth::user()->id);
		$user_province = $user->province->name;
		$url = Storage::url('public/files/' . $user->photoname);

		return redirect()->route('dashboard');
	}

	public function ShowUsers()
	{
		$users = User::all();
		return view('panels.users', ['users' => $users]);

	}
	public function ShowGuides()
	{
		$guides = User::all()->where('role', '=', 'guide')->load('guidepersons');
		return view('panels.guides', ['guides' => $guides]);
	}
	public function certificate(User $user)
	{
		$name = $user->guidepersons()->first()->orginalcertificatename;
		return Storage::download('public/certificates/'. $user->guidepersons()->first()->certificatename,$name);
	
	}
	public function active(User $user)
    {
		$user->Update(["active"=>1]);
        return redirect()->back();
        
    }
	
	public function unactive(User $user)
    {
		$user->Update(["active"=>0]);
		
        return redirect()->back();
        
    }
	public function ShowGuide(User $user)
	{
		$user_province = $user->province->name;
		$url = Storage::url('public/files/' . $user->photoname);

		if (Auth::user()) {
			$u = Auth::user();	
			$user_following = $u->following;
			$count = $user_following->where('user_id', $user->id)->count();
			if($count == 0)
			return view('panels.showGuide', ['user' => $user , 'photo_url' => $url , 'user_province'=>$user_province, 'message' => 0]);
			else
			return view('panels.showGuide', ['user' => $user , 'photo_url' => $url , 'user_province'=>$user_province , 'message' => 2]);
		} else {
			return view('panels.showGuide', ['user' => $user , 'photo_url' => $url , 'user_province'=>$user_province , 'message' => 1]);
		}
	}
	public function followUser(Request $request)
	{
		$user = Auth::user();
		$guideperson = Guideperson::all()->where('user_id', $request->user_id)->first();
		
		$user_following = $user->following;
		$count = $user_following->where('user_id', $request->user_id)->count();
		
		if ($count == 0) {
			$user->following()->attach($guideperson->id);
		}
		return redirect()->route('ShowGuide', [$guideperson->user_id]);
	}
	public function ShowFollowings()
	{
		$user = Auth::user();
		$user_following = $user->following;

		return view('panels.following', ['users' => $user->following]);
	}
}

