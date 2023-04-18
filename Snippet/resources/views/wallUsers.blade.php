<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            Wall of {{ $user->name }}
        </h2>
    </x-slot>
    <div>
    <div>

        <div id="presentation" class="flex flex-col text-center gap-1">
            <img src="{{ $user->url_photo }}" alt="Photo de profil" class="w-32 h-32 rounded-full object-cover mx-auto my-4">
            <p class="font-semibold text-xl text-gray-100 dark:text-gray-200 leading-tight">{{$user->name}}</p>
            <p class="font-regular text-base text-gray-100 dark:text-gray-200 leading-tight">{{$user->biography}}</p>
            <div id="subscription">
            @php
                $subscription = $subscriptions->firstWhere('followed_id', $user->id);
            @endphp
                @if ($subscription)
                <div>
                <x-primary-button class="m-4" wire:click.prevent="deleteSub({{ $user['id'] }}, {{ $subscription['id'] }})">
                    {{ __('SE DÉSABONNER') }}
                </x-primary-button>
                </div>
                @else
                <div>
                    <x-primary-button class="m-4" wire:click.prevent="addSub({{ $user['id'] }})">
                        {{ __("S'ABONNER") }}
                    </x-primary-button>
                </div>
                @endif
            </div>
        </div>

        <div class="max-w-3xl p-4 mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-8 mt-4">
                @foreach($posts as $post)
                <div class="block p-4 bg-white rounded shadow-sm hover:shadow overflow-hidden">   
               <div id="headerPost" class="flex flex-row break-words items-center">
                   <div id="profile-picture" class="flex items-center">
                       <img src="{{ $user->url_photo }}" alt="Photo de profil" class="w-12 h-12 rounded-full object-cover">
                       
                           <h2 class="truncate font-semibold text-lg text-gray-800 ml-3">
                           {{ $post['user']['name']}}
                            </h2>
                        
                        </div>
                    </div>
                        <div id="post-content" class="mt-2">
                            <h2 class="font-regular text-s text-gray-800">
                                {{ $post->description }}
                                <img src="{{ $post['img_url'] }}" class="w-full object-cover mt-2">
                            </h2>
                        <div id="post-footer" class="flex flex-row justify-between mt-3">
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
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>