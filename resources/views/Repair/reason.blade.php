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
                        <form action="{{ route('repair.reason',['repair'=>$repair]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <label class="label" for="device_name">Device Name</label>
                            <input type="text" name="device_name" placeholder="Device Name" class="input input-bordered" value="{{ $repair->service_request->device_name }}" disabled>
                            <label class="label" for="device_description">Symptoms</label>
                            <textarea class="textarea textarea-bordered min-w-full" name="device_description" style="min-height:100px" placeholder="Input Symptom" disabled>{{ $repair->service_request->device_description }}</textarea>
                            <label class="label" for="reason">Rejection Reason</label>
                            <textarea class="textarea textarea-bordered min-w-full" name="reason" style="min-height:100px" placeholder="Rejection Reason"></textarea>
                            <input class="btn mt-3" type="submit">
                        </form>
                    </div>                      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
