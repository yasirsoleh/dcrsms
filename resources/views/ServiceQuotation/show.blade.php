<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Service Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form action="{{ route('service_request.store') }}" method="POST">
                            @csrf
                            <label class="label" for="device_name">Device Name</label>
                            <input type="text" name="device_name" placeholder="Device Name" class="input input-bordered" value="{{ $service_request->device_name }}" disabled>
                            <label class="label" for="picture">Picture</label>
                            <img src="{{ base64_decode($service_request->picture) }}" class="">
                            <label class="label" for="device_description">Symptom or the damage information</label>
                            <textarea class="textarea textarea-bordered min-w-full" name="device_description" style="min-height:300px" placeholder="Input Symptom" disabled>{{ $service_request->device_description }}</textarea>
                        </form>
                    </div>                      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
