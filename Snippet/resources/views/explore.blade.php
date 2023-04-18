@php
    $connectedUserId = auth()->user()->id;
@endphp

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Explore') }}
    </h2>
</x-slot>
<div>
    <div>
        </div>
        <div class="container p-4 mx-auto">
            <h1 class="font-semibold text-2xl text-gray-800">All Posts</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8 mt-4">
                @foreach($posts as $post)
                <div class="block p-4 bg-white rounded shadow-sm hover:shadow overflow-hidden">
                    @if ($connectedUserId === $post['user']['id'])
                        <a href='/wall' class="truncate font-semibold text-lg text-gray-800">
                            {{$post['user']['name']}}
                        </a>
                    @else
                        <a href='/wall/{{ $post['user']['id']}}' class="truncate font-semibold text-lg text-gray-800">
                            {{$post['user']['name']}}
                        </a>
                    @endif
                    <a class="truncate font-semibold text-lg text-gray-800">
                        {{ $post['description'] }}
                    </a>
                    @if ($connectedUserId === $post['user']['id'])
                        <x-primary-button class="ml-3" wire:click.prevent="removePost({{ $post['id'] }})">
                            {{ __('🗑️') }}
                        </x-primary-button>
                    @endif
                    <img src="{{ $post['img_url'] }}">
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
                        </form>
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

            @if($hasMorePages)
                <div class="flex items-center justify-center mt-4">
                    <button
                        class="px-4 py-3 text-lg font-semibold text-white rounded-xl bg-green-500 hover:bg-green-400"
                        wire:click="loadPosts"
                    >
                        Load More
                    </button>
                </div>
            @endif
    </div>
</div>