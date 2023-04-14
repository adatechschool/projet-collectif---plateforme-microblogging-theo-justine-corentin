<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Explore') }}
        </h2>
    </x-slot>
    <div>
        <div>
            @include('layouts.post')
        </div>
    <!-- AFFICHAGE DE TOUS LES POSTS -->
    <div class="max-w-xl">
        @foreach($post as $posts)
            <p class="font-semibold text-xl text-gray-100 dark:text-gray-200 leading-tight">{{$posts->user->name}}</p>
            <img src="{{ $posts->user->url_photo }}" alt="Photo de profil" class="w-20 h-20 rounded-full object-cover">
            <p class="font-semibold text-xl text-gray-100 dark:text-gray-200 leading-tight">{{$posts->description}}</p>
            <img src="{{ $posts->img_url }}">
        @endforeach
        </div>
    </div>
</x-app-layout>