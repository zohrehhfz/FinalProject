<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Guideperson;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
   /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'photo' => ['sometimes' ,'mimes:jpg,png,jpeg,gif,svg','max:2048'],
            'phone' => ['required', 'string','min:11' ,'max:13'],
            'role' => 'required' 

        ]);
        

        $newphotofilename = "null";
		$photofilename = "null";
		if($request->photo != null)
		{
		
			$photofile = $request->file('photo');
			$photofilename = $photofile->getClientOriginalName();
			$extension = $photofile->extension();
			$newphotofilename = sha1(time().'_'.rand(1000000000,1999999999).'_'.rand(1000000000,1999999999).'_'.$photofilename);
			$newphotofilename = $newphotofilename.'.'.$extension;

			Storage::disk('local')->putFileAs(
				'public/files',
				$photofile,
				$newphotofilename
			);
		}
        $number = 1;
		if($request->role == "guide")
		{
			$number = 0;	
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'photoname' => $newphotofilename ,
			'orginalphotoname' => $photofilename ,
            'phone' => $request->phone,
             'role' => $request->role ,
             'active' => $number,
            'password' => Hash::make($request->password),
        ]);
        if($request->role == "guide")
		{
            Guideperson::create([
                'user_id' => $user->id,
            ]);
				
        }
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
