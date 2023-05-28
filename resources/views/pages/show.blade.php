<x-sidebarmain>

    <?php $comcount = 0;?>
    @foreach($comments as $comment)
        @if($comment->post->id == $post->id && $comment->hidden == 0)
            <?php $comcount++; ?>
        @endif
    @endforeach

    <?php
        $likecount = 0;
        $userliked = 0; //if 0, the user hasnt liked the post yet
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

    <!-- Post delete confirmation modal -->
    <div id="deleteModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative left-[13%] h-[80%] w-[70%] bg-gray-800 rounded-lg">
                <div class="flex items-start justify-between px-4 pt-3">
                    <h3 class="text-base font-semibold text-gray-900 px-1 dark:text-white">
                        Are you sure you want to delete this post?
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm p-1 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div>
                    <form action="{{$post->id}}" method="post">
                        @method('patch')
                        @csrf
                        <div class="border-0 border-gray-600 text-left">
                            <div class="pl-4">
                                <div class="inline-flex">
                                    <img class="h-12 w-12 object-cover rounded-full justify-end" src="{{$post->user->profile_photo_url}}"/>
                                    <div class="relative pl-2">
                                        <div class="inline-flex items-center">
                                            <p class="w-auto text-base text-white"><b>{{$post->user->displayname}}</b></p>
                                            @if($post->user->id == 1)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="pl-[0.35rem] text-emerald-500" viewBox="0 0 16 16"> <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/> </svg>
                                            @endif
                                        </div>
                                        <div class="absolute bottom-1">
                                            <div class="inline-flex">
                                                <p class="text-xs text-gray-400">@</p>
                                                <p class="text-xs text-gray-400">{{$post->user->name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pl-5">
                                <div>
                                    @if(!empty($post->image_path))
                                        @php
                                            $imgext = array('png', 'jpg', 'jpeg','gif');
                                            $ext = pathinfo($post->image_path, PATHINFO_EXTENSION);
                                        @endphp
                                        @if(in_array($ext,$imgext))
                                            <div class="grid md:grid-cols-pst pt-1">
                                                <div class="md:cols-pst">
                                                    <p class="text-sm text-gray-300 pb-2">{{$post->description}}</p>
                                                </div>
                                                <div class="">
                                                    <img class="rounded-xl border border-gray-700 w-[96%]" src="../images/{{$post->image_path}}">
                                                </div>
                                            </div>
                                        @else
                                            <div class="grid md:grid-cols-pst py-1">
                                                <div class="md:cols-pst">
                                                    <p class="text-sm text-gray-300 pb-2">{{$post->description}}</p>
                                                </div>
                                                <div class="align-content-between">
                                                    <video class="video-js rounded-xl border border-gray-700 w-[96%]" controls preload="auto" data-setup="{}">
                                                        <source src="../images/{{$post->image_path}}" type="video/mp4"/>
                                                    </video>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="md:cols-pst">
                                            <p class="text-sm text-gray-300 pt-2">{{$post->description}}</p>
                                        </div>
                                    @endif
                                </div>
                                <p class="py-3 text-sm text-gray-400">{{date('g:i A \• M j\, Y', strtotime($post->created_at))}}</p>
                            </div>
                            <div class="flex justify-center p-4">
                                <x-input type="number" id="post_id" name="post_id" value="{{$post->id}}" class="hidden"></x-input>
                                <x-input type="text" id="type" name="type" value="post" class="hidden"></x-input>
                                <x-input type="number" id="hidden" name="hidden" value="1" class="hidden"></x-input>
                                <x-button type="submit" class="bg-red-400">Delete</x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Post edit modal -->
    <div id="editModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative left-[13%] h-[80%] w-[70%] bg-gray-800 rounded-lg">
                <div class="flex items-start justify-between px-4 pt-3">
                    <h3 class="text-base font-semibold text-gray-900 px-1 dark:text-white">
                        Edit a post...
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm p-1 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div>
                    <form action="{{$post->id}}" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="border-0 border-gray-600 text-left">
                            <div class="pl-4">
                                <div class="inline-flex">
                                    <img class="h-12 w-12 object-cover rounded-full justify-end" src="{{$post->user->profile_photo_url}}"/>
                                    <div class="relative pl-2">
                                        <div class="inline-flex items-center">
                                            <p class="w-auto text-base text-white"><b>{{$post->user->displayname}}</b></p>
                                            @if($post->user->id == 1)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="pl-[0.35rem] text-emerald-500" viewBox="0 0 16 16"> <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/> </svg>
                                            @endif
                                        </div>
                                        <div class="absolute bottom-1">
                                            <div class="inline-flex">
                                                <p class="text-xs text-gray-400">@</p>
                                                <p class="text-xs text-gray-400">{{$post->user->name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pl-5">
                                <div>
                                    @if(!empty($post->image_path))
                                        @php
                                            $imgext = array('png', 'jpg', 'jpeg','gif');
                                            $ext = pathinfo($post->image_path, PATHINFO_EXTENSION);
                                        @endphp
                                        @if(in_array($ext,$imgext))
                                            <div class="grid md:grid-cols-pst pt-1">
                                                <div class="p-1 w-[96%] bg-gray-800">
                                                    <x-input type="text" name="description" value="{{$post->description}}" class="bg-gray-900 border-0 border-b border-gray-900 block w-full text-sm text-white h-10 active:border-0 active:border-b active:border-emerald-500"></x-input>
                                                </div>
                                                <div class="">
                                                    <img class="rounded-xl border border-gray-700 w-[96%]" src="../images/{{$post->image_path}}">
                                                </div>
                                            </div>
                                        @else
                                            <div class="grid md:grid-cols-pst py-1">
                                                <div class="p-1 w-[96%] bg-gray-800">
                                                    <x-input type="text" name="description" value="{{$post->description}}" class="bg-gray-900 border-0 border-b border-gray-900 block w-full text-sm text-white h-10 active:border-0 active:border-b active:border-emerald-500"></x-input>
                                                </div>
                                                <div class="align-content-between">
                                                    <video class="video-js rounded-xl border border-gray-700 w-[96%]" controls preload="auto" data-setup="{}">
                                                        <source src="../images/{{$post->image_path}}" type="video/mp4"/>
                                                    </video>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <div class="p-1 w-[96%] bg-gray-800">
                                            <x-input type="text" name="description" value="{{$post->description}}" class="bg-gray-900 border-0 border-b border-gray-900 block w-full text-sm text-white h-10 active:border-0 active:border-b active:border-emerald-500"></x-input>
                                        </div>
                                    @endif
                                </div>
                                <p class="py-3 text-sm text-gray-400">{{date('g:i A \• M j\, Y', strtotime($post->created_at))}}</p>
                            </div>
                            <div class="flex justify-center p-4">
                                <x-input type="number" id="post_id" name="post_id" value="{{$post->id}}" class="hidden"></x-input>
                                <x-input type="text" id="type" name="type" value="post" class="hidden"></x-input>
                                <x-button type="submit" class="bg-yellow-400">Save</x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="h-screen border-0 border-r border-gray-600">
        <div class="flex items-center h-12 pl-5">
            <form action="{{ url('/home') }}">
                <x-reactbtn class="px-1 py-1 rounded-full hover:bg-white hover:bg-opacity-10">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="text-white" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/> </svg>
                </x-reactbtn>
            </form>
            <p class="pl-[1.1rem] text-lg text-white"><b>Post</b></p>
        </div>
        <!--Message panel-->
        @if (session()->has('message'))
            <div class="pb-1 border-0 border-b border-gray-600">
                <div class="">
                    <div class="p-2 overflow-hidden">
                        <p class="text-center text-sm text-white">{{session()->get('message')}}</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="pt-2 border-0 border-b border-gray-600 text-left">
            <div class="flex justify-between pl-4">
                <div class="inline-flex">
                    <img class="h-12 w-12 object-cover rounded-full justify-end" src="{{$post->user->profile_photo_url}}"/>
                    <div class="relative pl-2">
                        <div class="inline-flex items-center">
                            <p class="w-auto text-base text-white"><b>{{$post->user->displayname}}</b></p>
                            @if($post->user->id == 1)
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="pl-[0.35rem] text-emerald-500" viewBox="0 0 16 16"> <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/> </svg>
                            @endif
                        </div>
                        <div class="absolute bottom-1">
                            <div class="inline-flex">
                                <p class="text-xs text-gray-400">@</p>
                                <p class="text-xs text-gray-400">{{$post->user->name}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pr-4">
                    @if(Auth::check())
                        @if(Auth::user()->id == $post->user->id)
                            <x-dropdown-post>
                                <x-slot name="trigger">
                                    <div class="inline-flex">
                                        <button type="button" class="inline-flex items-center rounded-full px-2 py-2 text-sm leading-4 font-medium text-white bg-gray-900 hover:bg-opacity-10 hover:bg-white focus:outline-none focus:bg-opacity-30 transition ease-in-out duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="self-center" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/> </svg> </svg>
                                            </svg>
                                        </button>
                                    </div>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link data-modal-target="editModal" data-modal-toggle="editModal">
                                        {{ __('Edit') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link data-modal-target="deleteModal" data-modal-toggle="deleteModal">
                                        {{ __('Delete') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown-post>
                        @endif
                    @endif
                </div>
            </div>

            <div class="pl-5">
                <div>
                    @if(!empty($post->image_path))
                        @php
                            $imgext = array('png', 'jpg', 'jpeg','gif');
                            $ext = pathinfo($post->image_path, PATHINFO_EXTENSION);
                        @endphp
                        @if(in_array($ext,$imgext))
                            <div class="grid md:grid-cols-pst pt-1">
                                <div class="md:cols-pst">
                                    <p class="text-sm text-gray-300 pb-2">{{$post->description}}</p>
                                </div>
                                <div class="">
                                    <img class="rounded-xl border border-gray-700 w-[96%]" src="../images/{{$post->image_path}}">
                                </div>
                            </div>
                        @else
                            <div class="grid md:grid-cols-pst py-1">
                                <div class="md:cols-pst">
                                    <p class="text-sm text-gray-300 pb-2">{{$post->description}}</p>
                                </div>
                                <div class="align-content-between">
                                    <video class="video-js rounded-xl border border-gray-700 w-[96%]" controls preload="auto" data-setup="{}">
                                        <source src="../images/{{$post->image_path}}" type="video/mp4"/>
                                    </video>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="md:cols-pst">
                            <p class="text-sm text-gray-300 pt-2">{{$post->description}}</p>
                        </div>
                    @endif
                </div>
                @if($post->created_at == $post->updated_at)
                    <p class="py-3 text-sm text-gray-400">{{date('g:i A \• M j\, Y', strtotime($post->created_at))}}</p>
                @else
                    <p class="py-3 text-sm text-gray-400">{{date('g:i A \• M j\, Y', strtotime($post->created_at))}} • Edited</p>
                @endif
                <div class="w-[95%] flex border-0 border-t border-gray-600">
                    <div class="flex py-3 text-sm hover:text-white hover:underline">
                        <span class="text-white"><b>{{$likecount}}</b></span>
                        <p class="text-gray-400">&nbsp;Likes</p>
                    </div>
                    <div class="flex pl-3 py-3 text-sm hover:text-white hover:underline">
                        <span class="text-white"><b>{{$comcount}}</b></span>
                        <p class="text-gray-400">&nbsp;Comments</p>
                    </div>
                </div>
                <div class="w-[95%] flex justify-between border-0 border-t border-gray-600">
                    <div class="relative flex items-center px-36 py-2 hover:text-rose-500 transition ease-in-out duration-200">
                        @if(Auth::check())
                            <form action="/postlike" method="post" enctype="multipart/form-data">
                                @csrf
                                @if($userliked == 1)
                                    <x-reactbtn type="submit" class="inline-flex text-xs text-rose-600 pt-1 pb-2 px-[0.35rem] rounded-full hover:bg-rose-600 hover:bg-opacity-20">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 -2 16 16"> <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/> </svg>
                                    </x-reactbtn>
                                @else
                                    <x-reactbtn type="submit" class="inline-flex text-xs text-white pt-1 pb-2 px-[0.35rem] rounded-full hover:bg-rose-600 hover:bg-opacity-20">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 -2 16 16"> <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/> </svg>
                                    </x-reactbtn>
                                @endif
                                <x-input type="number" id="post_id" name="post_id" value="{{$post->id}}" class="hidden"></x-input>
                            </form>
                        @else
                            <x-reactbtn type="submit" class="inline-flex text-xs text-white pt-1 pb-2 px-[0.35rem] rounded-full hover:bg-rose-600 hover:bg-opacity-20">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 -2 16 16"> <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/> </svg>
                            </x-reactbtn>
                        @endif
                    </div>
                    <div class="relative pl-7 text-white px-36 py-2 hover:text-blue-400 transition ease-in-out duration-200">
                        <reactbtn class="inline-flex text-xs pt-1 pb-2 px-[0.35rem] rounded-full hover:bg-blue-400 hover:bg-opacity-10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 -1 16 16"> <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/> </svg>
                        </reactbtn>
                    </div>
                </div>
            </div>

            <div class="pl-5">
                <div class="w-[95%] border-t border-gray-600">
                    <form action="/posts/" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="postid" value="{{$post->id}}">
                        <div class="grid grid-cols-7">
                            <div class="p-1 col-span-6">
                                <x-input type="text" name="content" placeholder="Write your reply!" class="bg-gray-900 border-0 border-b border-gray-900 block w-full text-sm text-white h-10 active:border-0 active:border-b active:border-emerald-500"></x-input>
                            </div>
                            <div class="p-2 col-span-1">
                                <x-input type="number" id="post_id" name="post_id" value="{{$post->id}}" class="hidden"></x-input>
                                <x-button type="submit">Post</x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div>
            @foreach($comments as $comment)
                <?php
                $comlikecount = 0;
                $usercomliked = 0; //if 0, the user hasnt liked the comment yet
                ?>
                @foreach($comlikes as $clike)
                    @if($comment->id == $clike->comment_id)
                        <?php $comlikecount++; ?>
                        @if(Auth::check())
                            @if($clike->user_id == Auth::user()->id)
                                <?php $usercomliked = 1;?>
                            @endif
                        @endif
                    @endif
                @endforeach

                @if($comment->post->id == $post->id && $comment->hidden == 0)
                    @if(Auth::check())
                        @if(Auth::user()->id == $comment->user_id)
                            <!-- Comment edit modal -->
                            <div id="comEditModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative left-[13%] h-[80%] w-[70%] bg-gray-800 rounded-lg">
                                        <div class="flex items-start justify-between px-4 pt-3">
                                            <h3 class="text-base font-semibold text-gray-900 px-1 dark:text-white">
                                                Edit a comment...
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm p-1 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="comEditModal">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div>
                                            <form action="{{$comment->id}}" method="post" enctype="multipart/form-data">
                                                @method('patch')
                                                @csrf
                                                <div class="border-0 border-gray-600 text-left">
                                                    <div class="pl-4">
                                                        <div class="inline-flex">
                                                            <img class="h-12 w-12 object-cover rounded-full justify-end" src="{{$comment->user->profile_photo_url}}"/>
                                                            <div class="relative pl-2">
                                                                <div class="inline-flex items-center">
                                                                    <p class="w-auto text-base text-white"><b>{{$comment->user->displayname}}</b></p>
                                                                    @if($comment->user->id == 1)
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="pl-[0.35rem] text-emerald-500" viewBox="0 0 16 16"> <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/> </svg>
                                                                    @endif
                                                                    <p class="text-xs text-gray-500 font-bold">{{$comment->id}}</p>
                                                                </div>
                                                                <div class="absolute bottom-1">
                                                                    <div class="inline-flex">
                                                                        <p class="text-xs text-gray-400">@</p>
                                                                        <p class="text-xs text-gray-400">{{$comment->user->name}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="pl-5">
                                                        <div>
                                                            <div class="p-1 w-[96%] bg-gray-800">
                                                                <x-input type="text" name="content" value="{{$comment->content}}" class="bg-gray-900 border-0 border-b border-gray-900 block w-full text-sm text-white h-10 active:border-0 active:border-b active:border-emerald-500"></x-input>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex justify-center p-4">
                                                        <x-input type="number" id="post_id" name="post_id" value="{{$post->id}}" class="hidden"></x-input>
                                                        <x-input name="type" value="comment" class="hidden"></x-input>
                                                        <x-button type="submit" class="bg-yellow-400">Save</x-button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Comment delete confirmation modal -->
                            <div id="comDeleteModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative left-[13%] h-[80%] w-[70%] bg-gray-800 rounded-lg">
                                        <div class="flex items-start justify-between px-4 pt-3">
                                            <h3 class="text-base font-semibold text-gray-900 px-1 dark:text-white">
                                                Are you sure you want to delete this comment?
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-full text-sm p-1 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="comDeleteModal">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div>
                                            <form action="{{$comment->id}}" method="post">
                                                @method('patch')
                                                @csrf
                                                <div class="border-0 border-gray-600 text-left">
                                                    <div class="pl-4">
                                                        <div class="inline-flex">
                                                            <img class="h-12 w-12 object-cover rounded-full justify-end" src="{{$comment->user->profile_photo_url}}"/>
                                                            <div class="relative pl-2">
                                                                <div class="inline-flex items-center">
                                                                    <p class="w-auto text-base text-white"><b>{{$comment->user->displayname}}</b></p>
                                                                    @if($comment->user->id == 1)
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="pl-[0.35rem] text-emerald-500" viewBox="0 0 16 16"> <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/> </svg>
                                                                    @endif
                                                                </div>
                                                                <div class="absolute bottom-1">
                                                                    <div class="inline-flex">
                                                                        <p class="text-xs text-gray-400">@</p>
                                                                        <p class="text-xs text-gray-400">{{$comment->user->name}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="pl-5">
                                                        <div>
                                                            <div class="md:cols-pst">
                                                                <p class="text-sm text-gray-300 pt-2">{{$comment->content}}</p>
                                                            </div>
                                                        </div>
                                                        <p class="py-3 text-sm text-gray-400">{{date('g:i A \• M j\, Y', strtotime($comment->created_at))}}</p>
                                                    </div>
                                                    <div class="flex justify-center p-4">
                                                        <x-input type="number" id="hidden" name="hidden" value="1" class="hidden"></x-input>
                                                        <x-input type="text" id="type" name="type" value="comment" class="hidden"></x-input>
                                                        <x-input type="number" id="post_id" name="post_id" value="{{$post->id}}" class="hidden"></x-input>
                                                        <x-button type="submit" class="bg-red-400">Delete</x-button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="relative grid grid-cols-9 w-full pb-3 border-b border-gray-600">
                                <div class="col-span-1">
                                    <img class="absolute h-11 w-11 top-[0.65rem] left-2 object-cover rounded-full flex justify-center items-center" src="{{$comment->user->profile_photo_url}}"/>
                                </div>
                                <div class="flex justify-between max-w-6xl pt-2 col-span-8">
                                    <div>
                                        <div class="flex items-center">
                                            <p class="font-bold text-base text-white">{{$comment->user->displayname}}</p>
                                            @if($comment->user_id == 1)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="pl-1 text-emerald-500" viewBox="0 0 16 16"> <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/> </svg>
                                            @endif
                                            <p class="pl-1 text-xs text-gray-500">@</p>
                                            @if(strtotime(now()) - strtotime($comment->created_at)<86400)
                                                @if($comment->created_at == $comment->updated_at)
                                                    <p class="text-xs text-gray-500">{{$comment->user->name}} • {{$comment->created_at->diffForHumans()}}</p>
                                                @else
                                                    <p class="text-xs text-gray-500">{{$comment->user->name}} • {{$comment->created_at->diffForHumans()}} • Edited</p>
                                                @endif
                                            @else
                                                @if($comment->created_at == $comment->updated_at)
                                                    <p class="text-xs text-gray-500">{{$comment->user->name}} • {{date('M j', strtotime($comment->created_at))}}</p>
                                                @else
                                                    <p class="text-xs text-gray-500">{{$comment->user->name}} • {{date('M j', strtotime($comment->created_at))}} • Edited</p>
                                                @endif
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-300">{{$comment->content}}</p>
                                        </div>
                                    </div>
                                    <div class="pr-4">
                                        <x-dropdown-post>
                                            <x-slot name="trigger">
                                                <div class="inline-flex">
                                                    <button type="button" class="inline-flex items-center rounded-full px-2 py-2 text-sm leading-4 font-medium text-white bg-gray-900 hover:bg-opacity-10 hover:bg-white focus:outline-none focus:bg-opacity-30 transition ease-in-out duration-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="self-center" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/> </svg> </svg>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </x-slot>

                                            <x-slot name="content">
                                                <x-dropdown-link data-modal-target="comEditModal" data-modal-toggle="comEditModal">
                                                    {{ __('Edit') }}
                                                </x-dropdown-link>
                                                <x-dropdown-link data-modal-target="comDeleteModal" data-modal-toggle="comDeleteModal">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </x-slot>
                                        </x-dropdown-post>
                                        <div class="inline-flex">
                                            <p class="text-sm text-white">{{$comlikecount}}</p>
                                            <form action="/commentlike" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <x-input type="number" id="post_id" name="post_id" value="{{$post->id}}" class="hidden"></x-input>
                                                <x-input type="number" id="comment_id" name="comment_id" value="{{$comment->id}}" class="hidden"></x-input>
                                                @if($usercomliked == 1)
                                                    <x-reactbtn type="submit" class="inline-flex text-xs text-rose-600 pt-1 pb-2 px-[0.35rem] rounded-full hover:bg-rose-600 hover:bg-opacity-20">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-heart" viewBox="0 -2 16 16"> <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/> </svg>
                                                    </x-reactbtn>
                                                @else
                                                    <x-reactbtn type="submit" class="text-xs text-white pt-1 pb-2 px-[0.35rem] rounded-full hover:bg-rose-600 hover:bg-opacity-20">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16"> <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/> </svg>
                                                    </x-reactbtn>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="relative grid grid-cols-9 w-full pb-3 border-b border-gray-600">
                                <div class="col-span-1">
                                    <img class="absolute h-11 w-11 top-[0.65rem] left-2 object-cover rounded-full flex justify-center items-center" src="{{$comment->user->profile_photo_url}}"/>
                                </div>
                                <div class="flex justify-between pr-4 max-w-6xl pt-2 col-span-8">
                                    <div>
                                        <div class="flex items-center">
                                            <p class="font-bold text-base text-white">{{$comment->user->displayname}}</p>
                                            @if($comment->user->id == 1)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="pl-1 text-emerald-500" viewBox="0 0 16 16"> <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/> </svg>
                                            @endif
                                            <p class="pl-1 text-xs text-gray-500">@</p>
                                            @if(strtotime(now()) - strtotime($comment->created_at)<86400)
                                                <p class="text-xs text-gray-500">{{$comment->user->name}} • {{$comment->created_at->diffForHumans()}}</p>
                                            @else
                                                <p class="text-xs text-gray-500">{{$comment->user->name}} • {{date('M j', strtotime($comment->created_at))}}</p>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-300">{{$comment->content}}</p>
                                        </div>
                                    </div>
                                    <div class="inline-flex items-center">
                                    <p class="text-sm text-white">{{$comlikecount}}</p>
                                        <form action="/commentlike" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <x-input type="number" id="post_id" name="post_id" value="{{$post->id}}" class="hidden"></x-input>
                                            <x-input type="number" id="comment_id" name="comment_id" value="{{$comment->id}}" class="hidden"></x-input>
                                            @if($usercomliked == 1)
                                                <x-reactbtn type="submit" class="inline-flex text-xs text-rose-600 pt-1 pb-2 px-[0.35rem] rounded-full hover:bg-rose-600 hover:bg-opacity-20">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-heart" viewBox="0 -2 16 16"> <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/> </svg>
                                                </x-reactbtn>
                                            @else
                                                <x-reactbtn type="submit" class="text-xs text-white pt-1 pb-2 px-[0.35rem] rounded-full hover:bg-rose-600 hover:bg-opacity-20">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16"> <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/> </svg>
                                                </x-reactbtn>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="relative grid grid-cols-9 w-full pb-3 border-b border-gray-600">
                            <div class="col-span-1">
                                <img class="absolute h-11 w-11 top-[0.65rem] left-2 object-cover rounded-full flex justify-center items-center" src="{{$comment->user->profile_photo_url}}"/>
                            </div>
                            <div class="max-w-6xl pt-2 col-span-8">
                                <div class="flex items-center">
                                    <p class="font-bold text-base text-white">{{$comment->user->displayname}}</p>
                                    @if($comment->user->id == 1)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="pl-1 text-emerald-500" viewBox="0 0 16 16"> <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/> </svg>
                                    @endif
                                    <p class="pl-1 text-xs text-gray-500">@</p>
                                    @if(strtotime(now()) - strtotime($comment->created_at)<86400)
                                        <p class="text-xs text-gray-500">{{$comment->user->name}} • {{$comment->created_at->diffForHumans()}}</p>
                                    @else
                                        <p class="text-xs text-gray-500">{{$comment->user->name}} • {{date('M j', strtotime($comment->created_at))}}</p>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm text-gray-300">{{$comment->content}}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>

</x-sidebarmain>
