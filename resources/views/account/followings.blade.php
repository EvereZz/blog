<x-layout>
    <x-setting heading="Your subscriptions">
        <div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <tbody class="bg-white divide-y divide-gray-200">
            @if ( $user->followings->count() )
            
            @foreach ($user->followings->reverse() as $follow)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10">
                      <x-avatar source='{{ $follow->author->avatar }}' id='{{ $follow->following_id }}' class="h-10 w-10 rounded-full" />
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      {{ $follow->author->name }}
                    </div>
                  </div>
                </div>
              </td>
              
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ $follow->author->email }}</div>
              </td>
              
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  Posts: {{ $follow->author->posts->count() }}
                </span>
              </td>
              
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <form method="POST" action="/account/followings/{{ $follow->author->username }}">
                    @csrf
                    @method('DELETE')
                    
                    <button class="text-xs text-gray-400">Unfollow</button>
                </form>
              </td>
            </tr>
            @endforeach
            
            @else
                <p class="text-center">No Followings Yet. You can add some if you like.</p>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
    </x-setting>
</x-layout>