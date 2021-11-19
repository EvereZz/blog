<x-layout>
    <x-setting heading="Publish new post">
        <form method="POST" action='/admin/posts/{{ $post->id }}' class="mt-10" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" :value="old('title', $post->title)" />

            <x-form.input name="slug" :value="old('slug', $post->slug)" />

            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type='file' :value="old('thumbnail', $post->thumbnail)" />
                </div>
                
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="thumbnail" class="rounded-xl ml-6 mt-6" width="100">
            </div>

            <x-form.textarea name="excerpt">{{ old('excerpt', $post->excerpt) }}</x-form.textarea>

            <x-form.textarea name="body">{{ old('body', $post->body) }}</x-form.textarea>

            <x-form.field>
                <x-form.label name="category" />

                <select class="bg-gray-200" name="category_id" id="category_id">
                    @foreach ($categories as $category)
                    <option 
                        value="{{ $category->id }}" 
                        {{ old('category_id', $post->category->id) == $category->id ? 'selected' : '' }}
                        >{{ ucwords($category->name) }}</option>
                    @endforeach
                </select>

                <x-form.error name="category" />
            </x-form.field>
            
            <x-form.field>
                <x-form.label name="author" />

                <select class="bg-gray-200" name="user_id" id="user_id">
                    @foreach ($authors as $author)
                    <option 
                        value="{{ $author->id }}" 
                        {{ old('author->id', $post->author->id) == $author->id ? 'selected' : '' }}
                        >{{ ucwords($author->name) }}</option>
                    @endforeach
                </select>

                <x-form.error name="author" />
            </x-form.field>
            
            <x-form.field>
                <x-form.label name="publish?" />
                
                <select class="bg-gray-200" name="published" id="published">
                    <option>Yes</option>
                    <option>No</option>
                </select>
                
                <x-form.error name="publish?" />
            </x-form.field>

            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>