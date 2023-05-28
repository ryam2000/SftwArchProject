<x-admin-layout>
    <h1 class="p-4 bg-gray-100">
        <p class="text-black text-2xl font-bold justify-center">
            Posts
        </p>
    </h1>

    <div class="p-4">
        <div>
            <p class="text-black text-xl font-normal justify-center">
                Create a new post
            </p>
        </div>
        <!--Error panel-->
        @if ($errors->any())
            <div class="py-2">
                <div class="">
                    <div class="bg-white p-2 overflow-hidden">
                        <p class="text-center text-sm">I'm sorry, the post wasn't created because:</p>
                        @foreach($errors->all() as $error)
                            <p class="text-center text-sm">{{$error}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <div class="flex items-center justify-center">
            <div class="border border-gray-200 p-8 w-1/4">
                <form method="post" action="/admin/users">
                    @csrf
                    <div class="text-sm">
                        <x-label for="description" value="Content" />
                        <x-input id="description" class="block mt-2 w-full" type="text" name="description" :value="old('description')" required autofocus />
                    </div>
                    <div class="hidden mt-4 text-sm">
                        <x-label for="name" value="Username" />
                        <x-input id="name" class="block mt-2 w-full" type="text" name="name" :value="old('name')" required autocomplete="name" />
                    </div>
                    <div class="hidden mt-4 text-sm">
                        <x-label for="email" value="Email" />
                        <x-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>
                    <div class="flex items-center justify-center mt-8">
                        <x-button type="submit"> Create new post </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="p-4">
        <div>
            <p class="text-black text-xl font-normal justify-center">
                Posts table
            </p>
        </div>
        <div class="pt-2 flex items-center justify-center">
            <div class="w-full">
                <table class="table table-striped border border-gray-200">
                    <thead class="bg-gray-900 text-white">
                        <tr>
                            <th class="w-[4%]">ID</th>
                            <th class="">Content</th>
                            <th class="">Image Path</th>
                            <th class="">Poster</th>
                            <th class="w-[6%]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr class="">
                            <td class="text-sm">{{ $post->id }}</td>
                            <td class="text-sm">{{ $post->description }}</td>
                            <td class="text-sm">{{ $post->image_path }}</td>
                            @php
                                $atdn = "@".$post->user->name;
                            @endphp
                            <td class="text-sm">{{$atdn}}</td>
                            <td class="">
                                <div class="flex justify-between">
                                    <a href="{{ url('admin/posts/'.$post->id.'/edit') }}" class="text-orange-400 hover:text-orange-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 -1 16 16"> <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/> <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/> </svg>
                                    </a>
                                    <a href="{{ url('admin/posts/'.$post->id) }}" class="text-blue-400 hover:text-blue-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 -1 16 16"> <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/> <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/> </svg>
                                    </a>
                                    {!! Form::open(['method'=>'DELETE', 'url' => ['admin/posts', $post->id], 'style' => '']) !!}
                                    {!! Form::button('<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="text-red-400 hover:text-red-200" viewBox="0 1 16 16"> <path d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z"/> </svg>', ['class' => '', 'type' => 'submit']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="p-2 flex justify-center">
            {{$posts->onEachSide(1)->links()}}
        </div>
    </div>
</x-admin-layout>
