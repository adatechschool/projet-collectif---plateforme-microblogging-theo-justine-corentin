<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center mt-16">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('dashboard.partials.update-dashboard-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('dashboard.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('dashboard.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <footer class="flex justify-between bg-gray-200 dark:bg-gray-800">
        <div class="flex justify-center items-center pl-6">
            <a href="https://www.linkedin.com/in/justinerougeulle/" class="text-center text-gray-500 dark:text-gray-400">
                Corentin Monvillers - 
            </a>
            <a href="https://www.linkedin.com/in/corentin-monvillers/" class="text-center text-gray-500 dark:text-gray-400">
                &nbsp;Justine Rougeulle -
            </a>
            <a href="https://www.linkedin.com/in/theo-seuge/" class="text-center text-gray-500 dark:text-gray-400">
                &nbsp;Théo Seugé
            </a>
        </div>
        <div class="flex justify-center items-center pr-6">
            <img src="https://i.imgur.com/49t8Tzw.png" alt="Logo" class="w-18 h-8 mx-auto my-4">
        </div>
    </footer>

</x-app-layout>
