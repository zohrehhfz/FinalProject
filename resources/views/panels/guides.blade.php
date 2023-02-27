@extends('layouts.my_layout')
@section('title', 'لیست راهنماها')
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
                                    <th scope="col">فعال/غیر فعال کردن</th>
                                    <th scope="col">نمایش مدرک</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0; ?>
                                @foreach($guides as $guide)
                                <tr>
                                    <th scope="row"><?php $count = $count + 1;
                                                    echo $count; ?></th>
                                    <?php
                                    $photo_url = Storage::url('public/files/' . $guide->photoname);
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
                                    <td>{{$guide->name}}</td>
                                    <td>{{$guide->phone}}</td>
                                    <td>{{$guide->email}}</td>
                                    <td>
                                        @if($guide->active == 1)
                                        <a href="{{route('unactiveguide',[$guide])}}" style="hover:text-red-700; color:red;"><button >غیر فعال کردن</button></a>
                                        @else
                                        <a href="{{route('activeguide',[$guide])}}" style="hover:text-gray-700; color:green;"><button >فعال کردن</button></a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($guide->guidepersons->certificatename != NULL)
                                        <button><a href="{{route('AdminSeeCertificate',[$guide])}}" style="color:green; text-decoration: none; hover:text-gray-700"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;نمایش مدرک <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award-fill mypen" viewBox="0 0 16 16">
                                                    <path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z" />
                                                    <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z" />
                                                </svg></a></button>
                                        @else
                                        <div style="bg-dark color:white; text-decoration: none; display:inline-block"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;بدون مدرک <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill mypen" viewBox="0 0 16 16">
                                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                            </svg></div>

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