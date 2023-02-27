<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Touristattraction;
use App\Models\Town;
use Illuminate\Support\Facades\Redirect;


class TouristattractionController extends Controller
{
    /**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$message = 0;
        $towns = Town::all();
		return view('attractions.add', ['message' => $message , 'towns' => $towns]);
	
	}

    public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'description' => 'required|string',
			'town' => 'required|string',
			'photo' => ['required','mimes:jpg,png,jpeg,gif,svg', 'max:2048']
		]);
		$t = Touristattraction::all()->where('name', $request->name)->count();
		if ($t > 0) {
			return redirect()->back()->withErrors(['error' => 'این مکان قبلا ثبت شده است']);
		}

		$p = Town::all()->where('name', $request->town)->pluck('id');
		
		$newphotofilename = "null";
		$photofilename = "null";
		if ($request->photo != null) 
		{
							
		$photofile = $request->file('photo');
		$photofilename = $photofile->getClientOriginalName();
		$extension = $photofile->extension();
		$newphotofilename = sha1(time() . '_' . rand(1000000000, 1999999999) . '_' . rand(1000000000, 1999999999) . '_' . $photofilename);
		$newphotofilename = $newphotofilename . '.' . $extension;

		Storage::disk('local')->putFileAs(
			'public/attractions',
			$photofile,
			$newphotofilename
		);
	}
	
	Touristattraction::Create([
		"name" => $request->name,
		"description" => $request->description,
		"photoname" => $newphotofilename,
        "town_id" => $p[0],
		"orginalphotoname" => $photofilename
	]);
	
		$message = 1;
		$towns = Town::all();
		return view('attractions.add', ['message' => $message ,'towns' => $towns]);
	}

	public function show(Touristattraction  $attraction)
	{
		//$town->comments;
		
		$url = Storage::url('public/attractions/' . $attraction->photoname);

		if (Auth::user()) {
			$user = Auth::user();
			$rl = $user->role;

			if (($rl == "admin") || ($rl == "guide")) {

				return view('attractions.show', ['attraction' => $attraction , 'photo_url' => $url , 'role' => 1]);
			}
			else {
				return view('attractions.show', ['attraction' => $attraction , 'photo_url' => $url , 'role' => 0]);
			}
		} 
		else {
			return view('attractions.show', ['attraction' => $attraction , 'photo_url' => $url , 'role' => 0]);
		}
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Touristattraction  $attraction
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Touristattraction  $attraction)
	{
		$user = Auth::user();

		$rl = $user->role;
		
		if (($rl == "admin") || ($rl == "guide")) {
			$towns = Town::all();
			return view('attractions.edit', ['attraction' => $attraction , 'towns' => $towns]);
		} else
		return redirect()->back()->withErrors(['error' => 'شما اجازه تغییر اطلاعات این استان را ندارید']);
	}
		
	public function update(Request $request,Touristattraction  $attraction)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'description' => 'required|string',
			'town' => 'required|string',
			'photo' => ['required','mimes:jpg,png,jpeg,gif,svg', 'max:2048']
		]);

		$p = Town::all()->where('name', $request->town)->pluck('id');
		
		$newphotofilename = "null";
		$photofilename = "null";
		if ($request->photo != null) 
		{
							
		$photofile = $request->file('photo');
		$photofilename = $photofile->getClientOriginalName();
		$extension = $photofile->extension();
		$newphotofilename = sha1(time() . '_' . rand(1000000000, 1999999999) . '_' . rand(1000000000, 1999999999) . '_' . $photofilename);
		$newphotofilename = $newphotofilename . '.' . $extension;

		Storage::disk('local')->putFileAs(
			'public/attractions',
			$photofile,
			$newphotofilename
		);
	}
	
	 DB::table('touristattractions')->where('id', $attraction->id)->update(array(
		"name" => $request->name,
		"description" => $request->description,
		"photoname" => $newphotofilename,
        "town_id" => $p[0],
		"orginalphotoname" => $photofilename
	));
	
	$attraction = Touristattraction::all()->where('id', $attraction->id);

	$url = Storage::url('public/attractions/' . $attraction[0]->photoname);

	if (Auth::user()) {
		$user = Auth::user();
		$rl = $user->role;

		if (($rl == "admin") || ($rl == "guide")) {

			return view('attractions.show', ['attraction' => $attraction[0] , 'photo_url' => $url , 'role' => 1]);
		}
		else {
			return view('attractions.show', ['attraction' => $attraction[0] , 'photo_url' => $url , 'role' => 0]);
		}
	} 
	else {
		return view('attractions.show', ['attraction' => $attraction[0] , 'photo_url' => $url , 'role' => 0]);
	}
	}


	public function remove(Touristattraction  $attraction)
	{
		Touristattraction::where('id', $attraction->id)->delete();
		$town = Town::where('id', $attraction->town_id)->get();
		
		$url = Storage::url('public/towns/' . $town[0]->photoname);

		if (Auth::user()) {
			$user = Auth::user();
			$rl = $user->role;
	
			if (($rl == "admin") || ($rl == "guide")) {
	
				return view('towns.show', ['town' => $town[0] , 'photo_url' => $url , 'role' => 1]);
			}
			else {
				return view('towns.show', ['town' => $town[0] , 'photo_url' => $url , 'role' => 0]);
			}
		} 
		else {
			return view('towns.show', ['town' => $town[0] , 'photo_url' => $url , 'role' => 0]);
		}	
	}
}
