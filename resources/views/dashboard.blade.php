@extends('layouts.my_layout')
@section('title', 'پنل کاربری')
@section('content')
<nav class="navbar navbar-expand-sm navbar-dark sticky-top">
	<div class="container-fluid">
		@if (Route::has('login'))
		@auth
		
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
					@if($photo_url == "/storage/files/null")
					<img src="/user.gif" class="img-fluid img-circle" alt="profile photo Not Set">
					@else
					<img src={{$photo_url}} class="img-fluid img-circle" alt="Profile photo UnAvialable">
					@endif

					<div class="div1" style="margin: auto; ">
						<p>نام :
							{{$user->name}}
						</p>
						<p> ایمیل :
							{{$user->email}}
						</p>
						<p> شماره تماس :
							{{$user->phone}}
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