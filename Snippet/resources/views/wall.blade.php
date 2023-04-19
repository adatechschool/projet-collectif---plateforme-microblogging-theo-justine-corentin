<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center mt-16">
            {{ __('My wall') }}
        </h2>
    </x-slot>
    <div>
    <div>
        <div id="presentation" class="flex flex-col text-center gap-1">
            <img src="{{ $user->url_photo }}" alt="Photo de profil" class="w-32 h-32 rounded-full object-cover mx-auto my-4 border-solid border-2 border-indigo-600 shadow-lg shadow-indigo-500/50">
            <p class="font-semibold text-xl text-gray-100 dark:text-gray-200 leading-tight">{{$user->name}}</p>
            <p class="font-regular text-base text-gray-100 dark:text-gray-200 leading-tight">{{$user->biography}}</p>
        </div>

        <div id="add-new-post">
            @include('layouts.post')
        </div>
        
        <div class="max-w-3xl p-4 mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-8 mt-4">
                @foreach($post as $posts)
                <div class="block p-4 bg-white rounded shadow-sm hover:shadow overflow-hidden">   
                
                    <div id="headerPost" class="flex flex-row break-words items-center">
                        <div id="profile-picture" class="flex items-center">
                            <img src="{{ $user->url_photo }}" alt="Photo de profil" class="w-12 h-12 rounded-full object-cover">
                            <h2 class="truncate font-semibold text-lg text-gray-800 ml-3">
                                {{ $user->name}}
                            </h2>  
                        </div>
                    </div>

                    <div id="post-content" class="mt-2 mb-4">
                        <h2 class="font-regular text-s text-gray-800">
                            {{ $posts->description }}
                            <img src="{{ $posts->img_url }}" class="w-full object-cover mt-2">
                        </h2>
                    </div>
                    
                    <div id="post-footer" class="flex">
                        <!-- form qui appel son controleur pour supprimer -->
                        <form action="{{ route('post.destroy', $posts->id) }}" method="POST" class="ml-auto">
                            @csrf
                            @method('DELETE')
                            <x-primary-button class="ml-auto"> 
                                {{ __('🗑️') }}
                            </x-primary-button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>