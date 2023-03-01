@extends('layouts.my_layout')
@section('title', 'پنل راهنما')
@section('content')
<nav class="navbar navbar-expand-sm navbar-dark sticky-top">
	<div class="container-fluid">
		@if (Route::has('login'))
		<a href="{{ route('welcome') }}" class="navbar-brand"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16" style="display:inline;">
  			<path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
			</svg> خانه </a>
		@auth
       
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
						@if($message != 2)
						<form action="{{ route('followUser') }}" method="post" style="display:inline">
						@csrf
						<?php $v = $user->id; ?>
						<input type="hidden" id="user_id" name="user_id" value ={{$v}}>

						<button id="submitbutton" type="submit" style="display:inline; background-color:#289e9e; color:white; margin:auto; margin-bottom:2%;;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16" style="display:inline;">
  						<path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
  						<path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
						</svg>&nbsp;&nbsp; دنبال کردن</button>
						</form>
						@else
						<button id="submitbutton" type="submit" style="display:inline; background-color:#289e9e; color:white; margin:auto; margin-bottom:2%;;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16" style="display:inline;">
  						<path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
						</svg>&nbsp;&nbsp; صفحه چت </button>
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