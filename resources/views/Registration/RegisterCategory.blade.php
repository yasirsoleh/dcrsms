<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
        <div class="space-y-3">
            <p class="text-2xl text-center">Register as</p>
            <a class="btn btn-block" href="{{ route('register.customer') }}">Customer</a>
            <a class="btn btn-block" href="{{ route('register.rider') }}">Rider</a>
        </div>
    </x-auth-card>
</x-guest-layout>
