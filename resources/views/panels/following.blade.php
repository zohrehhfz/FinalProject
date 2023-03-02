@extends('layouts.my_layout')
@section('title', 'دوستان ')
@section('content')

<x-app-layout>
    <button id="submitbutton" style="color:white; width:10%; display:inline; margin-right:65vw;"><a href="{{route('dashboard')}}">بازگشت</a> </button>
    <div class="py-12" style="font-size:18px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden sm:rounded-lg">
                <div class="p-6 border-b" dir=rtl style="margin: auto;">
                    <div style="border-radius:20px; margin: auto; box-shadow: 5px 5px 10px 5px #B3C5D8;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">تصویر کاربر</th>
                                    <th scope="col">نام</th>
                                    <th scope="col">ایمیل</th>
                                    <th scope="col">پیام‌ها</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0; ?>
                                @foreach($users as $user)
                                <tr>

                                    <th scope="row">
                                    <?php $count = $count + 1;
                                    echo $count; 
                                    $user->load('user');
                                    ?></th>
                                    <?php
                                    $photo_url = Storage::url('public/files/' . $user->user->photoname);
                                    if ($photo_url == "/storage/files/null") {
                                    ?>
                                        <td><img src="/user.gif" class="img-fluid img-circle" style="margin:auto; width:40px; height:40px;" alt="profile photo Not Set"></td>
                                    <?php
                                    } else {
                                    ?>
                                        <td> <img src="{{$photo_url}}" class="img-fluid img-circle" alt="Profile photo UnAvialable" style="margin:auto; width:30px; height:30px;"></td>
                                    <?php
                                    }
                                    ?>
                                    <td>{{$user->user->name}}</td>
                                    <td>{{$user->user->email}}</td>
                                    <td>
                                    <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16" style="margin:auto;">
                                    <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                     <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
                                    </svg></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
@endsection