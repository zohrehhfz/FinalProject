<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Province;
class ProvinceController extends Controller
{
    /**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$message = 0;
		return view('provinces.add', ['message' => $message]);
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
		$t = Province::all()->where('name', $request->name)->count();
		if ($t > 0) {
			return redirect()->back()->withErrors(['error' => 'این استان قبلا ثبت شده است']);
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
			'public/provinces',
			$photofile,
			$newphotofilename
		);
	}
	
	Province::Create([
		"name" => $request->name,
		"description" => $request->description,
		"photoname" => $newphotofilename,
		"orginalphotoname" => $photofilename
	]);
	
		$message = 1;
		return view('provinces.add', ['message' => $message]);
	}
}
