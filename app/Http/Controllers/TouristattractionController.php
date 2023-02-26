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
		if ($request->photo != null) {
							
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

}
