<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Feed') }}
        </h2>
    </x-slot>
    <form method="post" action="{{ route('feed.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('patch')
        <!-- DESCRIPTION -->
    <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input id="description" description="description" type="textarea" class="text-white mt-1 block w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
    </div>
        <!--  -->
    <div>
            <x-input-label for="img" :value="__('Image')" />
            <x-text-input id="img" img="img" type="textarea" class="text-white mt-1 block w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('img')" />
    </div>
    <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Publier') }}</x-primary-button>
            @if (session('status') === 'updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
    </div>
    </form>
</x-app-layout>