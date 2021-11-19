@props(['heading'])

<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b border-gray-300">
        {{ $heading }}
    </h1>

    <div class="flex">
        <aside class="w-48 flex-shrink-0">
            <h4 class="font-semibold mb-4">Links</h4>
            
            <ul>
                @admin
                    <li>
                        <a href="/admin/posts" class="{{ request()->is('admin/posts') ? 'text-blue-500' : ''}}">Dashboard</a>
                    </li>
                    <li>
                        <a href="/admin/posts/create" class="{{ request()->is('admin/posts/create') ? 'text-blue-500' : ''}}">New Post</a>
                    </li>
                @endadmin
                    <li>
                        <a href="/account/{{ auth()->user()->username }}" class="{{ request()->is('account/' . auth()->user()->username ) ? 'text-blue-500' : ''}}">Account</a>
                    </li>
                    <li>
                        <a href="/account/{{ auth()->user()->username }}/bookmarks" class="{{ request()->is('account/' . auth()->user()->username . '/bookmarks') ? 'text-blue-500' : ''}}">Bookmarks</a>
                    </li>
            </ul>

        </aside>

        <main class="flex-1">
            <x-panel>
                {{ $slot }}
            </x-panel>
        </main>
    </div>
</section> 