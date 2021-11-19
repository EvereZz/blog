@auth
<x-panel>
    <form method="POST" action='/posts/{{$post->slug}}/comments'>
        @csrf

        <header class="flex items-center">
            
            <x-avatar source='{{ auth()->user()->avatar }}' id='{{ auth()->user()->id }}' class="rounded-full" width="40" height="40" />

            <h2 class="ml-4">Want to participate?</h2>
        </header>

        <x-form.field>
            <textarea name="body" 
                      class="w-full text-sm focus:outline-none focus:ring" 
                      rows="5" 
                      placeholder="Quick, think of something to say!" 
                      required></textarea>

            @error('body')
                <span class="text-red-500 text-sm">The body field is required.</span>
            @enderror
        </x-form.field>

        <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
            <x-form.button>Post</x-form.button>
        </div>
    </form>
</x-panel>
@else
<x-panel class="bg-gray-50">
    <p class="font-semibold text-center">
        <a href="/register" class="hover:underline">Register</a> or 
        <a href="/login" class="hover:underline">Log in</a> to leave a comment
    </p>
</x-panel>
@endauth