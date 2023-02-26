@extends('layouts.my_layout')
@section('title', 'افزودن شهر')
@section('content')
<nav class="navbar navbar-expand-sm navbar-dark sticky-top">
	<div class="container-fluid">
		<ul class="navbar-nav">
			<li class="nav-item">
				@if (Route::has('login'))
				@auth
				<a href="{{ url('/dashboard') }}" class="navbar-brand"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
						<path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
					</svg> پنل کاربری </a>
				@endauth

	</div>
	@endif
	</li>

	</ul>
	</div>
</nav>
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">


	@if ($errors->any())
	<ul>
		@foreach ($errors->all() as $error)
		<li style="color:#E74C3C">{{ $error }}</li>
		@endforeach
	</ul>
	@endif

	@if( $message == "1" )
	<p> استان با موفقیت ثبت شده است</p>
	@endif
	<form action="{{ route('StoreTown') }}" method="post" enctype="multipart/form-data">
		@csrf
		<div>
		<p> آپلود تصویر :</p>
		<input type="file" name="photo" id="photo">
		<p style="font-size:20px;"> نام: </p>
		<input type="text" name="name" placeholder="نام شهر را وارد کنید" style="font-size:20px;">
		<br>
		<br>
		</div>

		<div>
		<p style="font-size:20px;"> توضیحات  : </p>
		<textarea  name="description" value=" " rows="4" style="font-size:18px;" class="w-50"> </textarea>
		 
		<br>
		<br>
		</div>
		<div >
		<p style="font-size:20px;"> نام استان  : </p>
		<input list="provincess" name="province" id="provinces">
		<datalist id="provincess">
		@foreach($provinces as $province)
    	<option value="{{$province->name}}"></option>
		@endforeach
  		</datalist>
		<br>
		<br>
		</div>
		
		<button type="submit" id="submitbutton" style="color:white;"> ثبت <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
				<path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
			</svg></button>

</div>
</form>
@endsection