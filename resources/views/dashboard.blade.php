@extends('layouts.my_layout')
@section('title', 'پنل کاربری')
@section('content')
<nav class="navbar navbar-expand-sm navbar-dark sticky-top">
	<div class="container-fluid">
		@if (Route::has('login'))
		@auth
		<a href="{{ route('welcome') }}" class="navbar-brand"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16" style="display:inline;">
  			<path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
			</svg> خانه </a>
		<form method="POST" action="{{ route('logout') }}">
			@csrf
			<a href="{{ route('logout') }}" onclick="event.preventDefault();
                    this.closest('form').submit();" class="navbar-brand hover:text-gray-700"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16" style="display:inline;">
					<path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
					<path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
				</svg> خروج از حساب </a>

		</form>

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
				@if($user->role == "guide")
					@if($user->guidepersons->certificatename == NULL)
					<div class="alert alert-primary d-flex align-items-center" role="alert">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
							<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
						</svg>
						برای اینکه حساب شما به عنوان راهنما فعال شود مدرک خود را آپلود کنید.
						<div style="margin:auto">
							<button id="submitbutton" style="margin-left: -30vw;"><a href="{{route('EditUserGuideInfo')}}" style="color:white; text-decoration: none; "> به روز رسانی حساب</a></button>
						</div>
					</div>
					@elseif($user->active != "1")
					<div class="alert alert-primary d-flex align-items-center" role="alert">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
							<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
						</svg>
						مدرک شما به زودی بررسی خواهد شد.
					</div>
					@endif
					@endif
			
					@if($photo_url == "/storage/files/null")
					<img src="/user.gif" class="img-fluid img-circle" alt="profile photo Not Set">
					@else
					<img src={{$photo_url}} class="img-fluid img-circle" alt="Profile photo UnAvialable">
					@endif

					<div class="div1" style="margin: auto;">
					@if($user->role == "guide")
						@if($user->guidepersons->certificatename != NULL)
						<button class="certificatebutton"><a href="{{route('ShowCertificate',[$user])}}" style="color:white; text-decoration: none;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;نمایش مدرک <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award-fill mypen" viewBox="0 0 16 16">
									<path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z" />
									<path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z" />
								</svg></a></button>

						@endif
						@if($user->active == true)
						<p>وضعیت: فعال </p>
						@else
						<p> وضعیت : غیر فعال</p>
						@endif
						@endif

						<p>نام :
							{{$user->name}}
						</p>
						<p> ایمیل :
							{{$user->email}}
						</p>
						<p> شماره تماس :
							{{$user->phone}}
						</p>
						<p> استان محل سکونت :
							{{$user_province}}
						</p>
						<p> حساب در تاریخ
							<?php $v = new Verta($user->created_at);
							print $v->formatJalaliDate(); ?>
							ایجاد شده است
						</p>
						<p> بیوگرافی :
							{{$user->bio}}
						</p>
						<br>
		    <br>
            <hr>
            <br>
		    <br>
						<button id="submitbutton" style="margin:auto;"><a href="{{ route('EditUserGuideInfo') }}" style="color:white; text-decoration: none; "> به روز رسانی حساب</a></button>

					</div>
				</div>
				
			</div>
		</div>
	</div>
</x-app-layout>
@endsection