<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Town;

class TownController extends Controller
{
   /**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$message = 0;
		return view('towns.add', ['message' => $message]);
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'description' => 'required|string',
			'photo' => ['required','mimes:jpg,png,jpeg,gif,svg', 'max:2048']
		]);
		$t = Town::all()->where('name', $request->name)->count();
		if ($t > 0) {
			return redirect()->back()->withErrors(['error' => 'این شهر قبلا ثبت شده است']);
		}
		
		$newphotofilename = "null";
		$photofilename = "null";
		if ($request->photo != null) {
							
		$photofile = $request->file('photo');
		$photofilename = $photofile->getClientOriginalName();
		$extension = $photofile->extension();
		$newphotofilename = sha1(time() . '_' . rand(1000000000, 1999999999) . '_' . rand(1000000000, 1999999999) . '_' . $photofilename);
		$newphotofilename = $newphotofilename . '.' . $extension;

		Storage::disk('local')->putFileAs(
			'public/towns',
			$photofile,
			$newphotofilename
		);
	}
	
	Town::Create([
		"name" => $request->name,
		"description" => $request->description,
		"photoname" => $newphotofilename,
        "province_id" => 1,
		"orginalphotoname" => $photofilename
	]);
	
		$message = 1;
		return view('towns.add', ['message' => $message]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Town  $town
	 * @return \Illuminate\Http\Response
	 */
	public function show(Town  $towne)
	{
		//$town->comments;
		$url = Storage::url('public/towns/' . $town->photoname);

		if (Auth::user()) {
			$user = Auth::user();
			$rl = $user->role;

			if (($rl == "admin") || ($rl == "guide")) {

				return view('towns.show', ['town' => $town , 'photo_url' => $url , 'role' => 1]);
			}
			else {
				return view('towns.show', ['town' => $town , 'photo_url' => $url , 'role' => 0]);
			}
		} 
		else {
			return view('towns.show', ['town' => $town , 'photo_url' => $url , 'role' => 0]);
		}
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Town  $town
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Town  $town)
	{
		$user = Auth::user();

		$rl = $user->role;
		
		if (($rl == "admin") || ($rl == "guide")) {
			return view('towns.edit', ['town' => $town]);
		} else
			return redirect()->back()->withErrors(['error' => 'شما اجازه تغییر اطلاعات این استان را ندارید']);
	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Town  $town
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request,Town  $town)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'description' => 'required|string',
			'photo' => ['required','mimes:jpg,png,jpeg,gif,svg', 'max:2048']
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
			'public/towns',
			$photofile,
			$newphotofilename
		);
	}

	DB::table('towns')->where('id', $town->id)->update(array(

		"name" => $request->name,
		"description" => $request->description,
		"photoname" => $newphotofilename,
		"orginalphotoname" => $photofilename
	));
	
	$url = Storage::url('public/towns/' . $town->photoname);

	if (Auth::user()) {
		$user = Auth::user();
		$rl = $user->role;

		if (($rl == "admin") || ($rl == "guide")) {

			return view('towns.show', ['town' => $town , 'photo_url' => $url , 'role' => 1]);
		}
		else {
			return view('towns.show', ['town' => $town , 'photo_url' => $url , 'role' => 0]);
		}
	} 
	else {
		return view('towns.show', ['town' => $town , 'photo_url' => $url , 'role' => 0]);
	}
	}
}
