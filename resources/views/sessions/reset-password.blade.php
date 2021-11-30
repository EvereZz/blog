<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Set new password</h1>

                <form method="POST" action='/reset-password' class="mt-10">
                    @csrf
                    
                    <input type="hidden" name="token" value="{{ $token }}">

                    <x-form.input name="email" type="email" autocomplete="username" />

                    <x-form.input name="password" type="password" autocomplete="new-password" />

                    <x-form.input name="password_confirmation" type="password" autocomplete="new-password"  />

                    <x-form.button>Confirm reset</x-form.button>
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>