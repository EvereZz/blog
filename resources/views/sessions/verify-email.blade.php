<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Verify email address!</h1>

                <p class="mt-5 text-center">We sent you a link to confirm your email address. <br />
                    Please click on that link to finish registration.</p>

                <div class="text-center">
                    <form method="POST" action='/email/verification-notification' class="mt-10">
                        @csrf

                        <x-form.button>Send new link</x-form.button>
                    </form>
                </div>
            </x-panel>
        </main>
    </section>
</x-layout>