<!-- FORM TO ADD POST WHIT TEXT AND IMG TO DB -->
<section>
    <div class="bg-gray-100 dark:bg-gray-900 p4">
            <!-- fond de couleur blanc -->
            <div class="max-w-3xl mx-auto py-10 px-4">
                <!-- fond de couleur gris et en long -->
                <div class=" bg-gray-200 p-4 rounded mx-auto text-center"> 
                    <form action="{{ route('post.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <label for="text" class="sr-only">Text</label>
                            <textarea name="text" id="text" cols="30" rows="4" class="bg-gray-100 border-1 w-full p-4 rounded @error('text') border-red-500 @enderror" placeholder="What's up today?"></textarea>
                            @error('text')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="picture" class="sr-only">Picture</label>
                            <input type="text" name="img_url" id="img_url" class="bg-gray-100 border-1 w-full p-4 rounded @error('img_url') border-red-500 @enderror" placeholder="Picture URL">
                            @error('picture')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                            <!-- Input inivisble dissant sur quelle page est l'user -->
                            <input type="hidden" name="page" value="{{ Request::url() }}">
                        <div>
                            <button type="submit" class="bg-pink-700 text-white p-2 rounded mt-2 font-medium inline-block">Add post</button>
                            @if (session('status') === 'Post créé avec succès') <div class="mt-2 text-sm">{{ session('status') }}</div> @endif
                            @if (session('error')) <div class="mt-2 text-sm">{{ session('error') }}</div> @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

