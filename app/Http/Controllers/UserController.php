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

class UserController extends Controller
{
    public function edit()
	{
		$user = Auth::user();
		return view('panels.edit', ['user' => $user]);
	}  
    public function update(Request $request)
	{
		$user = Auth::user();
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'phone' => ['required', 'string', 'min:11', 'max:13'],
			'bio' => ['required', 'string'],
			'photo' => ['mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
			'certificate' => ['mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
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
		
		DB::table('users')->where('id', $user->id)->update(array(
			'name' => $request->name,
			'email' => $request->email,
			'phone' => $request->phone,
			'bio' => $request->bio,
		));
		$user = User::find(Auth::user()->id);
		$url = Storage::url('public/files/' . $user->photoname);
		return view('dashboard', ['user' => $user, 'photo_url' => $url]);
	}

}
