<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Wall') }}
        </h2>
    </x-slot>
    <div>
        <div>
            @include('layouts.post')
        </div>
    <div>
        <p class="font-semibold text-xl text-gray-100 dark:text-gray-200 leading-tight">User: {{$user->name}}</p>
        <p class="font-semibold text-xl text-gray-100 dark:text-gray-200 leading-tight">Biographie: {{$user->biography}}</p>
        <img src="{{ $user->url_photo }}" alt="Photo de profil" class="w-20 h-20 rounded-full object-cover">
        <div class="container p-4 mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8 mt-4">
                @foreach($post as $posts)
                <div class="block p-4 bg-white rounded shadow-sm hover:shadow overflow-hidden">
                    <h2 class="truncate font-semibold text-lg text-gray-800">
                        {{ $user->name}}
                    </h2>
                    <h2 class="truncate font-semibold text-lg text-gray-800">
                        {{ $posts->description }}
                    </h2>
                    <x-primary-button class="ml-3">
                        {{ __('🗑️') }}
                    </x-primary-button>
                    <img src="{{ $posts->img_url }}" class="object-cover">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>