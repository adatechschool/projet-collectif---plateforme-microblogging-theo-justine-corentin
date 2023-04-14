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
        @foreach($post as $posts)
            <p class="font-semibold text-xl text-gray-100 dark:text-gray-200 leading-tight">{{$posts->description}}</p>
            <img src="{{ $posts->img_url }}" class="object-cover">
        @endforeach
    </div>
</x-app-layout>