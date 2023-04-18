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
                @foreach($posts as $post)
                <div class="block p-4 bg-white rounded shadow-sm hover:shadow overflow-hidden">
                    <h2 class="truncate font-semibold text-lg text-gray-800">
                        {{ $post['user']['name']}}
                    </h2>
                    <h2 class="truncate font-semibold text-lg text-gray-800">
                        {{ $post->description }}
                    </h2>
                    <img src="{{ $post->img_url }}" class="object-cover">
                    @php
                        $likesCollection = collect($post['likes']);
                        $userLikedPost = $likesCollection->contains('user_id', auth()->user()->id);
                    @endphp
                    <!-- LIKÉ -->
                    @if ($userLikedPost)
                        <div>
                            <x-primary-button class="ml-3" wire:click.prevent="removeLike({{ $post['id'] }}, {{ $likesCollection->firstWhere('user_id', auth()->user()->id)['id'] }})">
                                {{ __('Unlike') }}
                            </x-primary-button>
                        </div>
                    @else
                    <!-- NON LIKÉ -->
                        <div>
                            <x-primary-button class="ml-3" wire:click.prevent="addLike({{ $post['id'] }})">
                                {{ __('like') }}
                            </x-primary-button>
                        </div>
                    @endif
                <p>{{$likesCollection->count()}} ❤️</p>
            </div>
            @endforeach
            </div>
        </div>
    </div>