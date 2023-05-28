<x-sidebarmain>

    <div class="w-full border-1 border-r border-gray-600">
        <!--Greeting message (checking for authentication)-->
        @if (Auth::check())

            <!--Post creation panel-->
            <div class="py-2 border-0 border-b border-gray-600">
                <span class="px-4 py-2 text-lg text-white">Make a post...</span>
                <div class="max-w-6xl">
                    <div class="pt-4 pl-4 grid grid-cols-12 bg-gray-900 rounded rounded-3xl p-2 overflow-hidden">
                        <div class="col-span-1">
                            <img class="h-10 w-10 object-cover rounded-full justify-end" src="{{ Auth::user()->profile_photo_url }}"/>
                        </div>
                        <div class="col-span-11">
                            <form action="/home" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="p-1">
                                    <x-input type="text" name="description" placeholder="What's on your mind?" class="bg-gray-900 border-0 border-b border-gray-900 block w-full text-sm text-white h-10 active:border-0 active:border-b active:border-emerald-500"></x-input>
                                </div>
                                <div class="flex justify-between pr-2 h-8">
                                    <div class="justify-start">
                                        <label class="flex items-center justify-center h-8 pl-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="text-emerald-500 hover:text-gray-500" viewBox="0 0 16 16"><path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                                <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                                            </svg>
                                            <input type="file" name="image" class="file:hidden text-white px-4 py-2 text-xs file:rounded-full">
                                        </label>
                                    </div>
                                    <x-button type="submit">Post</x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!--Message panel-->
        @if (session()->has('message'))
            <div class="py-2 border-0 border-b border-gray-600">
                <div class="">
                    <div class="p-2 overflow-hidden">
                        <p class="text-center text-sm text-white">{{session()->get('message')}}</p>
                    </div>
                </div>
            </div>
        @endif

        <!--Error panel-->
        @if ($errors->any())
            <div class="py-2 border-0 border-b border-gray-600">
                <div class="">
                    <div class="p-2 overflow-hidden">
                        <p class="text-center text-sm text-white">I'm sorry, the post wasn't posted because:</p>
                        @foreach($errors->all() as $error)
                            <p class="text-center text-sm text-red-400">{{$error}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Main modal -->
        <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative h-[8.6rem] bg-gray-800 rounded-lg">
                    <div class="flex items-start justify-between px-4 pt-3">
                        <h3 class="text-base font-semibold text-gray-900 px-1 dark:text-white">
                            Make a post...
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm p-1 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div>
                        <form action="/home" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="py-2 px-4 pb-2">
                                <x-input type="text" name="description" placeholder="What's on your mind?" class="bg-gray-900 rounded-full border-gray-900 block w-full text-sm text-white h-10 active:border-emerald-500"></x-input>
                            </div>
                            <div class="flex justify-between px-4 h-8">
                                <div class="justify-start">
                                    <label class="flex items-center justify-center h-8 pl-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="text-emerald-500 hover:text-gray-500" viewBox="0 0 16 16"><path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                            <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                                        </svg>
                                        <input type="file" name="image" class="file:hidden text-white px-4 py-2 text-xs file:rounded-full">
                                    </label>
                                </div>
                                <x-button type="submit">Post</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Dynamic post style-->
        <div>
            @foreach ($posts as $post)
                @if($post->hidden == 0)
                    <form action="{{ url('posts/'.$post->id) }}">
                        <x-postcontainer class="relative grid grid-cols-12 text-left">
                            <div class="col-span-1">
                                <img class="h-11 w-11 object-cover rounded-full flex justify-center" src="{{$post->user->profile_photo_url}}"/>
                            </div>
                            <div class="relative max-w-6xl pl-2 col-span-11">
                                <div class="flex items-center">
                                    <p class="font-bold text-base text-white">{{$post->user->displayname}}</p>
                                    @if($post->user->id == 1)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="pl-1 text-emerald-500" viewBox="0 0 16 16"> <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/> </svg>
                                    @endif
                                    <p class="pl-1 text-xs text-gray-400">@</p>
                                    @if(strtotime(now()) - strtotime($post->created_at)<86400)
                                        @if($post->created_at == $post->updated_at)
                                            <p class="text-xs text-gray-400">{{$post->user->name}} • {{$post->created_at->diffForHumans()}}</p>
                                        @else
                                            <p class="text-xs text-gray-400">{{$post->user->name}} • {{$post->created_at->diffForHumans()}} • Edited</p>
                                        @endif
                                    @else
                                        @if($post->created_at == $post->updated_at)
                                            <p class="text-xs text-gray-400">{{$post->user->name}} • {{date('M j', strtotime($post->created_at))}}</p>
                                        @else
                                            <p class="text-xs text-gray-400">{{$post->user->name}} • {{date('M j', strtotime($post->created_at))}}  • Edited</p>
                                        @endif
                                    @endif
                                </div>
                                <div class="overflow-hidden pb-1">
                                    @if(!empty($post->image_path))
                                        @php
                                            $imgext = array('png', 'jpg', 'jpeg','gif');
                                            $ext = pathinfo($post->image_path, PATHINFO_EXTENSION);
                                        @endphp
                                        @if(in_array($ext,$imgext))
                                            <div class="grid md:grid-cols-pst py-1">
                                                <div class="md:cols-pst">
                                                    <p class="text-sm text-gray-300 pb-2">{{$post->description}}</p>
                                                </div>
                                                <div class="align-content-between">
                                                    <img class="rounded-xl border border-gray-700 w-[96%]" src="images/{{$post->image_path}}" alt="">
                                                </div>
                                            </div>
                                        @else
                                            <div class="grid md:grid-cols-pst py-1">
                                                <div class="md:cols-pst">
                                                    <p class="text-sm text-gray-300 pb-2">{{$post->description}}</p>
                                                </div>
                                                <div class="align-content-between">
                                                    <video class="video-js rounded-xl border border-gray-700 w-[96%]" controls preload="auto" data-setup="{}">
                                                        <source src="images/{{$post->image_path}}" type="video/mp4"/>
                                                    </video>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="py-1 md:cols-pst">
                                            <p class="text-sm text-gray-300">{{$post->description}}</p>
                                        </div>
                                    @endif
                                </div>

                                <?php $comcount = 0;?>
                                @foreach($comments as $comment)
                                    @if($comment->post->id == $post->id && $comment->hidden == 0)
                                        <?php $comcount++; ?>
                                    @endif
                                @endforeach

                                <?php
                                    $likecount = 0;
                                    $userliked = 0;
                                ?>
                                @foreach($likes as $like)
                                    @if($post->id == $like->post_id)
                                        <?php $likecount++; ?>
                                        @if(Auth::check())
                                            @if($like->user_id == Auth::user()->id)
                                                <?php $userliked = 1;?>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach

                                <div class="flex pb-1">
                                    <div class="relative flex items-center hover:text-rose-500 transition ease-in-out duration-200">
                                        @if($userliked == 1)
                                            <reactbtn class="inline-flex text-xs text-rose-600 pt-1 pb-2 px-[0.35rem] rounded-full hover:bg-rose-600 hover:bg-opacity-20">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-heart" viewBox="0 -2 16 16"> <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/> </svg>
                                            </reactbtn>
                                        @else
                                            <reactbtn class="inline-flex text-xs text-white pt-1 pb-2 px-[0.35rem] rounded-full hover:bg-rose-600 hover:bg-opacity-20">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-heart" viewBox="0 -2 16 16"> <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/> </svg>
                                            </reactbtn>
                                        @endif
                                        <span class="absolute bottom-[0.4rem] left-7 text-xs text-white">{{$likecount}}</span>
                                    </div>
                                    <div class="relative pl-7 text-white hover:text-blue-400 transition ease-in-out duration-200">
                                        <reactbtn class="inline-flex text-xs pt-1 pb-2 px-[0.35rem] rounded-full hover:bg-blue-400 hover:bg-opacity-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-chat" viewBox="0 -1 16 16"> <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/> </svg>
                                        </reactbtn>
                                        <span class="absolute bottom-[0.4rem] text-xs">{{$comcount}}</span>
                                    </div>
                                </div>
                            </div>
                        </x-postcontainer>
                    </form>
                @endif
            @endforeach
        </div>
    </div>

</x-sidebarmain>
