<x-layout>
    <x-setting heading="Your Account">
        <form method="POST" action='/account/{{ auth()->user()->id }}' enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <x-form.field>
                <x-avatar source='{{ $user->avatar }}' id='{{ $user->id }}' class="rounded-xl ml-6 mt-6" />
                
                <div class="flex-1">
                    <x-form.input name="avatar" type='file' :value="old('avatar', $user->avatar)" />
                </div>
                
            </x-form.field>

            <x-form.input name="name" :value="old('name', $user->name)" />

            <x-form.input name="username" :value="old('username', $user->username)" />

            <x-form.input name="email" type="email" :value="old('email', $user->email)" />

            <x-form.input name="password" type="password" autocomplete="current-password"/>
            
            <p class='text-xs'>Confirm changes with password</p>

            <x-form.button>Update</x-form.button>
        </form>
        <a href="/account/{{ auth()->user()->username }}">
            <button type="submit" 
                    class="text-black-300 mt-5 hover:underline ml-12"
                    >
                Back
            </button>
        </a>
    </x-setting>
</x-layout>