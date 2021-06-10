<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Delivery') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form action="{{ route('delivery.store') }}" method="POST">
                            @csrf
                            <input type="text" name="service_request_id" placeholder="Service Request ID" class="input input-bordered" value="{{ $service_request->id }}" hidden>
                            <label class="label" for="device_description">Delivery Address</label>    
                            <textarea class="textarea textarea-bordered min-w-full" name="address" style="min-height:100px" placeholder="Input Address">{{ $service_request->customer->address }}</textarea>
                            <br><input class="btn mt-3" type="submit">
                        </form>
                    </div>                      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
