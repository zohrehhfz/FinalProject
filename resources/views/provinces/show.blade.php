@extends('layouts.my_layout')
@section('title', 'استان')
@section('content')
<nav class="navbar navbar-expand-sm navbar-dark sticky-top">
	<div class="container-fluid">
		<ul class="navbar-nav">
			<li class="nav-item">
				@if (Route::has('login'))
				<a href="{{ route('welcome') }}" class="navbar-brand"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16" style="display:inline;">
  			<path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
			</svg> خانه </a>
				@auth
				@if(Auth::user()->role == "admin")
				<a href="{{ route('CreateProvince') }}" class="navbar-brand"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
					</svg> افزودن استان </a>
				<a href="{{ route('CreateTown') }}" class="navbar-brand"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
				</svg> افزودن شهر </a>
				@endif
				<a href="{{ url('/dashboard') }}" class="navbar-brand"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
						<path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
					</svg> پنل کاربری </a>
				@else
				<a href="{{ route('login') }}" class="navbar-brand"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
						<path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
					</svg> ورود به حساب </a>

				@if (Route::has('register'))
				<a href="{{ route('register') }}" class="navbar-brand"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-person-fill" viewBox="0 0 16 16">
						<path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm2 5.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-.245S4 12 8 12s5 1.755 5 1.755z" />
					</svg>
					ثبت نام</a>
				@endif
				@endauth

	</div>
	@endif
	</li>

	</ul>
	</div>
</nav>

<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
	<div class="div1" style="width:70%; margin:auto;">
		<br>
		@if($photo_url == "/storage/provinces/")
		<figure>
			<img src="/travel-agency.jpg" class="img-fluid" style="margin:auto; width:25%; height:25%;" alt="profile photo Not Set">
			<figcaption style="font-size: 14px;">تصویر یافت نشد</figcaption>
		</figure>

		@else
		<img src={{$photo_url}} class="img-fluid img-circle2" style="margin:auto; width:60%; height:60%;" alt="Profile photo UnAvialable">
		@endif
		<br>
		<br>
		<h4> نام استان : {{$province->name}}</h4>
		<p> {{$province->description}}</p>
		<br>
		<br>

		
		<div class="container">
			<div class="" style="margin:auto">
				<div class="row">
				@foreach ($province->towns as $town)
					<div class="col-3">
					<h5 style="text-align: justify; margin-right:4%;">
					{{$town->name}}
					</h5>				
					<p style="text-align: justify; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3;  line-clamp: 3; -webkit-box-orient: vertical;">
					{{$town->description}}
					</p>
				</div>
					<div class="col-3">
						<?php
						$photo_url = Storage::url('public/towns/' . $town->photoname);
						if ($photo_url == "/storage/provinces/") {
						?>
							<img src="/travel-agency.jpg" class="img-fluid img-circle2"style="margin-right:12%; width:80%; height:80%;" alt=" photo Not Set">
							
						<?php
						} else {
						?>
								<a href="{{route('ShowTown',[$town])}}"><img src="{{$photo_url}}" class="img-fluid img-circle2" alt=" photo UnAvialable" style="margin-right:0%; width:100%; height:100%;"></a>
								<?php
								}
								?>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		<br>
		<br>
		
	


		<p>  راهنماهای استان {{$province->name}}</p>
		@foreach($guidepersons as $guideperson)
		<a style="text-decoration:none"  href="{{route('ShowGuide',[$guideperson])}}"><p> نام راهنما : {{$guideperson->name}}</p></a>
		@endforeach

		@if($role == 1)
				<button id="submitbutton"><a href="{{ route('EditProvinces',[$province]) }}" style="color:white; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
							<path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
						</svg> تغییر اطلاعات استان </a></button>

				<button id="submitbutton"><a href="{{ route('RemoveProvinces',[$province]) }}" style="color:white; text-decoration: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
							<path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
						</svg>  حذف استان </a></button>
				@endif
	</div>
	<br>
	<br>
	<div class="comments container" style="margin: auto;">

		<br>
		<div class="sub_cm" style="background: none;">
			<div class="row">
				<div style="text-align: right;">
					<h6> <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-collection-fill" viewBox="0 0 16 16">
							<path d="M0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z" />
						</svg> &nbsp; نظرات</h6>
				</div>
			</div>
		</div>
		@if($province->comments->count() == 0)
		<div class="sub_cm">
			<div class="row">
				<div class="col">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-text-fill" viewBox="0 0 16 16">
						<path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM4.5 5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4z" />
					</svg>
				</div>
				<div class="col-11">
					اولین نفری باشید که برای این سفر نظری ثبت می‌کند.
				</div>
			</div>
		</div>
		@else
		@foreach($province->comments as $c)
		<div class="sub_cm">
			<div class="row">
				<div class="col">
					<?php
					$user = $c->user;
					$photo_url = Storage::url('public/files/' . $user->photoname);
					$name = $user->name;
					if ($photo_url == "/storage/files/null") {
					?>
						<img src="/user.gif" class="img-fluid img-circle" style="margin-right:0vw; width:40px; height:40px;" alt="profile photo Not Set">
					<?php
					} else {
					?>
						<img src="{{$photo_url}}" class="img-fluid img-circle" alt="Profile photo UnAvialable" style="margin-right:0vw; width:30px; height:30px;">
					<?php
					}
					?>
				</div>
				<div class="col-11">
					<p style="font-size:1vw;">{{$name}}:</p>
					<p style="font-size:0.99vw;">{{$c->message}}</p>
				</div>
			</div>
		</div>
		<?php $auth_user = Auth::user();
		?>
		
		@if($auth_user->role == "admin")
		
		<div style="float:left; margin-top :-40px;"> <a href="{{route('DeleteComment' , [ $c ])}}"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" style="margin-right: -14px; margin-top: -3vh; color:red;" class="bi bi-trash-fill" viewBox="0 0 16 16">
					<path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
				</svg></a></div>
		@endif

		@endforeach
		@endif
		<div class="sub_cm">
			<div class="row">
				<form id="commentform" action="{{route('SetComment')}}" method="post">
					@csrf
					<textarea name="message" id="commentform" cols="90" rows="1" placeholder="نظر خود را درباره این سفر بنویسید." style="border: none;"></textarea>
					<input type="hidden" id="province" name="province" value={{ $province->id }}>
					<button id="submitbutton" type="submit" style="color:white; width:auto; display:inline; margin:auto;"> ثبت <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
							<path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
						</svg></button>
				</form>
			</div>
		</div>
		<br>
		<br>
	</div>
	<br>
	<br>

	<br>
	<br>


</div>
@endsection