@extends('layouts.my_layout')
@section('title', 'چت')
@section('content')
<x-app-layout>
<button id="submitbutton" style="color:white; width:10%; display:inline; margin-right:65vw;"><a href="{{route('dashboard')}}">بازگشت</a> </button>

    <div class="py-12" style="font-size:18px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="width:70%; margin:auto;">
                <div class="p-6 border-b border-gray-200" dir=rtl style="margin: auto; background-color: #E5EAEE  ;">
                    <div class="chat-history" style="font-size: 15px;">
                        <div style="margin-left: 78%">
                        <?php
                                    $photo_url = Storage::url('public/files/' . $contact->photoname);
                                    if ($photo_url == "/storage/files/null") {
                                    ?>
                                        <td><img src="/user.gif" class="img-fluid img-circle" style="display:inline; width:70px; height:70px;" alt="profile photo Not Set"></td>
                                    <?php
                                    } else {
                                    ?>
                                        <td> <img src="{{$photo_url}}" class="img-fluid img-circle" alt="Profile photo UnAvialable" style="display:inline; width:30px; height:30px;"></td>
                                    <?php
                                    }
                                    ?>
                                    <p style="display:inline;">{{$contact->name}}</p>
                         </div>
                        <br>
                        <br>
                        <ul>
                        <div class=" w-100">
                                @foreach($chats as $message)
                                <?php
                                $user_id = $message->user_id;
                                $user1 = DB::table('users')->select(['name','orginalphotoname','photoname'])->where('id',$user_id)->get();
                                $photo_url = Storage::url('public/files/' . $user1[0]->photoname);
                                $name = $user1[0]->name;

                                $guide_id = $message->guideperson_id;
                                $guided = DB::table('guidepersons')->select(['user_id'])->where('id',$guide_id)->get();
                                $guide = DB::table('users')->select(['name','orginalphotoname','photoname'])->where('id',$guided[0]->user_id)->get();

                                $photo_urlg = Storage::url('public/files/' . $guide[0]->photoname);
                                $nameg = $guide[0]->name;
                                ?>
                              
                               @if($message->flag == 1)
                                <li class="clearfix" style="margin-left: 20vw;">
                                    <div class="float-right" style="background-color: #A1C4E7  ; border-radius:20px; width: fit-content; margin: auto;">
                                        <div class="d-inline" dir="rtl" style="text-align: right; color:#6D7173;">
                                            <i style="text-align: right;">
                                                <div style="float: right;">

                                                    <?php
                                                    if ($photo_url == "/storage/files/null") {
                                                    ?>
                                                        <img src="/user.gif" class="img-fluid img-circle d-inline" style="margin-right:1vw; width:40px; height:40px;" alt="profile photo Not Set">
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <img src="{{$photo_url}}" class="img-fluid img-circle d-inline" alt="Profile photo UnAvialable" style="margin-right:1vw; width:40px; height:40px;">
                                                    <?php
                                                    }
                                                    ?>

                                                    {{$name}}
                                                </div>
                                                <div class="d-inline" style="float: left;"> <?php $v2 = new Verta($message->created_at);
                                                                                            print $v2->formatJalaliDate(); ?></div>
                                            </i>
                                        </div>
                                        <br> <br>
                                        <div class="pl-2" style=" text-align: right;">{{$message->message}}</div>
                                        <br>

                                        <br>
                                    </div>
                                    <div></div>
                                </li>
                                <br>

                                @else
                                <li class="clearfix" style="margin-right: 33vw; float:left;">
                                        <div class="float-left" style=" text-align: right; background-color:#C8DBED; border-radius:10px; width: fit-content; margin: auto;">
                                                <div class="d-inline" dir="rtl" style="text-align: right; color:#6D7173;">
                                                    <i style="text-align: right;">
                                                        <div style="float: right;">{{$nameg}}</div>
                                                        <div style="float: left;"><?php $v2 = new Verta($message->created_at);
                                                                                    print $v2->formatJalaliDate(); ?></div>
                                                    </i>
                                                </div>
                                                <br>
                                                <div class="pb-4" style=" text-align: right;">
                                                    {{$message->message}}
                                                </div>
                                        </div>
                                        <div>
                                            

                                        </div>
                                        <br>
                                </li>
                                <br>
                                <br>
                                @endif
                                @endforeach
                            </div>                      
                        </ul>
                    </div>
                    <!-- end chat -->
                    <br>
                    <br>
                    <div class="sub_cm" style="background-color:#A1C4E7; width:auto">
                        <div class="row">
                            <form id="commentform" action="" method="post">
                                @csrf
                                <div style="margin-top:2vh; margin-bottom:2vh;">
                                    
                                    
                                    <textarea name="message" id="commentform" cols="70" rows="1" placeholder="پیام خود را بنویسید."></textarea>
                                    <button id="submitbutton" type="submit" style="background-color:#D9E7F3; color:black; width:auto; display:inline; margin:auto;"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                            <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                        </svg></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection