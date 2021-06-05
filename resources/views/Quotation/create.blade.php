<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quotation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form action="{{ route('quotation.store') }}" method="POST">
                            @csrf
                            <label class="label" for="device_name">Device Name</label>
                            <input type="text" name="service_request_id" placeholder="Service Request ID" class="input input-bordered" value="{{ $service_request->id }}" hidden>
                            <input type="text" name="device_name" placeholder="Device Name" class="input input-bordered" value="{{ $service_request->device_name }}" disabled>
                            <label class="label" for="device_description">Symptom or the damage information</label>
                            <textarea class="textarea textarea-bordered min-w-full" name="device_description" style="min-height:100px" placeholder="Input Symptom" disabled>{{ $service_request->device_description }}</textarea>
                            <label class="label" for="device_name">Description</label>
                            <textarea class="textarea textarea-bordered min-w-full" name="description" style="min-height:100px" placeholder="Quotation Description"></textarea>
                            <label class="label" for="device_name">Cost</label>
                            <input type="number" name="cost" placeholder="Cost" class="input input-bordered">
                            <br><input class="btn mt-3" type="submit">
                        </form>
                    </div>                      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
