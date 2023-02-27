@extends('layouts.my_layout')
@section('title', 'ایجاد حساب ')
@section('content')

    <form method="POST" action="{{ route('register') }}" dir="rtl" enctype="multipart/form-data">
        @csrf

        <div> آپلود عکس شما : </div>
			<div> <input type="file" name="photo" id="photo"> </div>
			<br>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('نام')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('ایمیل')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required style="margin-left: 16px;"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('تلفن همراه')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required style="margin-left: 55px;"/>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="mt-4">
		<x-input-label style="font-size:20px;" /> استان محل زندگی : 
		<x-text-input list="provinces" name="provincename"   style="margin-left: 105px;" />
		<datalist id="provinces">
		@foreach($provinces as $province)
    	<option value="{{$province->name}}"></option>
		@endforeach
  		</datalist>
		<br>
		<br>
		</div>
        <div class="mt-4">
				
				<input type="radio" id="user" name="role" value="user">
				 <label for="html">کاربر</label>
				 <input type="radio" id="leader" name="role" value="guide">
				 <label for="css">راهنما</label>
            </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('رمز عبور')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" style="margin-left: 35px;"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('تکرار رمز عبور')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required style="margin-left: 70px;"/>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('ورود به حساب') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('ثبت نام') }}
            </x-primary-button>
        </div>
    </form>

@endsection