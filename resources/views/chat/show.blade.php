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
                        <div><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-quote-fill d-inline" viewBox="0 0 16 16">
                                <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM7.194 6.766a1.688 1.688 0 0 0-.227-.272 1.467 1.467 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 5.734 6C4.776 6 4 6.746 4 7.667c0 .92.776 1.666 1.734 1.666.343 0 .662-.095.931-.26-.137.389-.39.804-.81 1.22a.405.405 0 0 0 .011.59c.173.16.447.155.614-.01 1.334-1.329 1.37-2.758.941-3.706a2.461 2.461 0 0 0-.227-.4zM11 9.073c-.136.389-.39.804-.81 1.22a.405.405 0 0 0 .012.59c.172.16.446.155.613-.01 1.334-1.329 1.37-2.758.942-3.706a2.466 2.466 0 0 0-.228-.4 1.686 1.686 0 0 0-.227-.273 1.466 1.466 0 0 0-.469-.324l-.008-.004A1.785 1.785 0 0 0 10.07 6c-.957 0-1.734.746-1.734 1.667 0 .92.777 1.666 1.734 1.666.343 0 .662-.095.931-.26z" />
                            </svg>صفحه چت اعضای تور </div>
                        <br>
                        <br>
                        <ul>

                            
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
                                    <?php $i = $travel->id;
                                    ?>
                                    
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