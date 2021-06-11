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
                            <label class="label" for="device_name">Device Name</label>
                            <label class="label" for="device_description">Symptom or the damage information</label>
                            <textarea class="textarea textarea-bordered min-w-full" name="device_description" style="min-height:100px" placeholder="Input Symptom" disabled>{{ $service_request->device_description }}</textarea>
                            <div class="justify-items-end block">
                            @if (Auth::user()->hasRole('staff') && $service_request->approval_status == 'waiting')
                                <label class="label" for="device_description">Approval</label>
                                <a class="btn" href="{{ route('service_request.staff_approve', $service_request) }}">Accept</a>
                                <a class="btn" href="{{ route('service_request.rejection_reason', $service_request) }}">Reject</a>
                            @endif
                            @if ($service_request->approval_status == 'no')
                                <label class="label" for="rejection_reason">Rejection Reason</label>
                                <textarea class="textarea textarea-bordered min-w-full" name="rejection_reason" style="min-height:100px" placeholder="Rejection Reason" disabled>{{ $service_request->rejection_reason }}</textarea>
                            @endif
                            </div>
                        </form>
                    </div>                      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
