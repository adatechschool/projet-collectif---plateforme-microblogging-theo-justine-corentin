<!-- FORM TO ADD POST WHIT TEXT AND IMG TO DB -->
<section>
    <div class="bg-gray-100 dark:bg-gray-800">
            <!-- fond de couleur blanc -->
            <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
                <!-- fond de couleur gris et en long -->
                <div class="w-2/8 bg-gray p-6 rounded-lg">
                    <form action="{{ route('post.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="text" class="sr-only">Text</label>
                            <textarea name="text" id="text" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('text') border-red-500 @enderror" placeholder="Your text"></textarea>
                            @error('text')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="picture" class="sr-only">Picture</label>
                            <input type="text" name="img_url" id="img_url" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('img_url') border-red-500 @enderror" placeholder="Picture url">
                            @error('picture')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                            <!-- Input inivisble dissant sur qu'elle page est l'user -->
                            <input type="hidden" name="page" value="{{ Request::url() }}">
                        <div>
                            <button type="submit" class="bg-gray-500 text-white px-4 py-3 rounded font-medium w-full">Add post</button>
                            @if (session('status') === 'Post créé avec succès') <div class="mt-2 text-sm">{{ session('status') }}</div> @endif
                            @if (session('error')) <div class="mt-2 text-sm">{{ session('error') }}</div> @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

