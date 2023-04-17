
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
                        @php
                            $connectedUserId = auth()->user()->id;
                        @endphp
                    @if ($connectedUserId === $post['user']['id'])
                        <a href='/wall' class="truncate font-semibold text-lg text-gray-800">
                    @else
                        <a href='/walls/{{ $post['user']['id']}}' class="truncate font-semibold text-lg text-gray-800">
                    @endif
                    <a class="truncate font-semibold text-lg text-gray-800">
                        {{ $post['description'] }}
                    </a>

                    <img src="{{ $post['img_url'] }}">
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