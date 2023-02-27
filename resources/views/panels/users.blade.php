@extends('layouts.my_layout')
@section('title', 'کاربران سایت')
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
                                    <th scope="col">شماره تماس</th>
                                    <th scope="col">ایمیل</th>
                                    <th scope="col">نقش کاربر</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0; ?>
                                @foreach($users as $user)
                                <tr>

                                    <th scope="row"><?php $count = $count + 1;
                                                    echo $count; ?></th>
                                    <?php
                                    $photo_url = Storage::url('public/files/' . $user->photoname);
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
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        
                                        @if($user->role == "admin")
                                        مدیر
                                        @endif
                                        @if($user->role == "guide")
                                        راهنما
                                        @endif
                                        @if($user->role == "user")
                                        کاربر
                                        @endif
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