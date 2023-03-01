@extends('layouts.my_layout')
@section('title', 'پنل راهنما')
@section('content')
<nav class="navbar navbar-expand-sm navbar-dark sticky-top">
	<div class="container-fluid">
		@if (Route::has('login'))
		@auth
        <a href="{{ route('welcome') }}" class="navbar-brand"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16" style="display:inline;">
  			<path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
			</svg> خانه </a>
		@endauth
	</div>
	@endif
	</li>

	</ul>
	</div>
</nav>


<x-app-layout>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 bg-white border-b border-gray-200" dir=rtl>		
					@if($photo_url == "/storage/files/null")
					<img src="/user.gif" class="img-fluid img-circle" alt="profile photo Not Set">
					@else
					<img src={{$photo_url}} class="img-fluid img-circle" alt="Profile photo UnAvialable">
					@endif

					<div class="div1" style="margin: auto;">
						@if($user->guidepersons->certificatename != NULL)
						<button class="certificatebutton"><a href="{{route('ShowCertificate',[$user])}}" style="color:white; text-decoration: none;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;نمایش مدرک <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award-fill mypen" viewBox="0 0 16 16">
									<path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z" />
									<path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z" />
								</svg></a></button>

						@endif
						<p>نام :
							{{$user->name}}
						</p>
						<p> ایمیل :
							{{$user->email}}
						</p>
						<p> استان محل سکونت :
							{{$user_province}}
						</p>
						<p> بیوگرافی :
							{{$user->bio}}
						</p>
						<br>
		    <br>
            <hr>
            <br>
		    <br>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</x-app-layout>
@endsection