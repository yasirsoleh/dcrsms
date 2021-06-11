<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="hero py-10">
                        <div class="text-center hero-content">
                            <div class="max-w-md">
                                <h1 class="mb-5 text-5xl">
                                    Hello {{ $data->first_name }}!
                                </h1> 
                                @if (Auth::user()->hasRole('customer'))
                                    <p class="mb-5">
                                        Welcome to Dercs Computer Repair Shop
                                    </p> 
                                    <a href="{{ route('service_request.index') }}" class="btn">Get Started</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
