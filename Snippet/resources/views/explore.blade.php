@php
    $connectedUserId = auth()->user()->id;
@endphp

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center mt-16">
        {{ __('Explore') }}
    </h2>
</x-slot>
<div>
    <div>
        </div>
        <div class="max-w-3xl p-4 mx-auto">
            <h1 class="font-semibold text-2xl text-white">All Posts</h1>
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-8 mt-4">
                @foreach($posts as $post)
                <div class=" block p-4 bg-white rounded shadow-sm hover:shadow overflow-hidden">
                <div id="headerPost" class="flex flex-row justify-between break-words items-center">
                    <div class="flex flex-row items-center justify-between">
                        <div id="profile-picture">
                            <img src="{{ $post['user']['url_photo'] }}" alt="Photo de profil" class="w-12 h-12 rounded-full object-cover">
                        </div>
                        <div class="flex flex-row">
                            @if ($connectedUserId === $post['user']['id'])
                            <a href='/wall' class="truncate font-semibold text-lg text-gray-800 ml-3 hover:text-indigo-700">
                                {{$post['user']['name']}}
                            </a>
                            @else
                                @php
                                    $subscription = $subscriptions->firstWhere('followed_id', $post['user']['id']);
                                @endphp
                                    <a href='/wall/{{ $post['user']['id']}}' class="truncate font-semibold text-lg text-gray-800 ml-3 hover:text-indigo-700">
                                        {{$post['user']['name']}}
                                    </a>
                                    @if ($subscription)
                                        <div class="ml-auto">
                                            <x-primary-button class="ml-3" wire:click.prevent="deleteSub({{ $subscription['id'] }})">
                                                {{ __('SE DÉSABONNER') }}
                                            </x-primary-button>
                                        </div>
                                    @else
                                        <div class="ml-auto">
                                            <x-primary-button class="ml-3" wire:click.prevent="addSub({{ $post['user']['id'] }})">
                                                {{ __("S'ABONNER") }}
                                            </x-primary-button>
                                        </div>
                                    @endif
                            @endif
                            <br />
                        </div>
                    </div>  
                </div>
                <div id="post-content" class="mt-2 mb-4 ">
                    <a class="font-regular text-s text-gray-800">
                        {{ $post['description'] }}
                    </a>
                    <img src="{{ $post['img_url'] }}" class="w-full object-cover mt-2">
                </div>
                <div id="post-footer" class="flex flex-row justify-between ">
                    <div id="likes" class="flex flex-row items-center">
                        @php
                            $likesCollection = collect($post['likes']);
                            $userLikedPost = $likesCollection->contains('user_id', auth()->user()->id);
                        @endphp
                        <!-- LIKÉ -->
                        @if ($userLikedPost)
                        <div>
                            <x-primary-button class="" wire:click.prevent="removeLike({{ $post['id'] }}, {{ $likesCollection->firstWhere('user_id', auth()->user()->id)['id'] }})">
                                {{ __('Unlike') }}
                            </x-primary-button>
                        </div>
                        
                        @else
                            <!-- NON LIKÉ -->
                            <div>
                                <x-primary-button class="" wire:click.prevent="addLike({{ $post['id'] }})">
                                    {{ __('like') }}
                                </x-primary-button>
                            </div>
                        @endif      
                        <p class="ml-3">{{$likesCollection->count()}} ❤️</p>   
                    </div>
                    <div id="deletePost">
                        @if ($connectedUserId === $post['user']['id'])
                            <x-primary-button class="ml-3" wire:click.prevent="removePost({{ $post['id'] }})">
                                {{ __('🗑️') }}
                            </x-primary-button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
            @if($hasMorePages)
                <div class="flex items-center justify-center mt-4">
                    <button
                        class="px-4 py-3 text-lg font-semibold text-white rounded-xl bg-indigo-600 hover:bg-indigo-500"
                        wire:click="loadPosts"
                    >
                        Load more posts
                    </button>
                </div>
            @endif
    </div>
</div>