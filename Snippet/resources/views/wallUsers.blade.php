<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Wall of {{ $user->name }}
        </h2>
    </x-slot>
    <div>
    <div>
        <p class="font-semibold text-xl text-gray-100 dark:text-gray-200 leading-tight">Biography: {{$user['biography']}}</p>
        <img src="{{ $user['url_photo'] }}" alt="Photo de profil" class="w-20 h-20 rounded-full object-cover">
        <div class="container p-4 mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8 mt-4">
                @foreach($posts as $posts)
                <div class="block p-4 bg-white rounded shadow-sm hover:shadow overflow-hidden">
                    <h2 class="truncate font-semibold text-lg text-gray-800">
                        {{ $posts['user']['name']}}
                    </h2>
                    <h2 class="truncate font-semibold text-lg text-gray-800">
                        {{ $posts->description }}
                    </h2>
                    <img src="{{ $posts->img_url }}" class="object-cover">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>