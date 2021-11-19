<x-layout>
    <x-setting heading="Your bookmarks">
        <div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <tbody class="bg-white divide-y divide-gray-200">
            @if ( $user->bookmarks->count() )
            
            @foreach ($user->bookmarks->reverse() as $bookmark)
            <tr>
                
              <td class=" px-6 py-4 ">
                <div class="items-center">
                  <div class="text-sm font-medium text-gray-900">
                      <a href="/posts/{{ $bookmark->post->slug }}">
                        {{ $bookmark->post->title }}
                      </a>
                  </div>
                </div>
              </td>
              
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <form method="POST" action="/account/bookmarks/{{ $bookmark->post->slug }}">
                    @csrf
                    @method('DELETE')
                    
                    <button class="text-xs text-gray-400">Delete</button>
                </form>
              </td>
                 
            </tr>
            @endforeach
            
            @else
                <p class="text-center">No Bookmarks Yet. You can add some if you like it.</p>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
    </x-setting>
</x-layout>