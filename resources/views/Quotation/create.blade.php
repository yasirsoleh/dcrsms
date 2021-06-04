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
                            <input type="text" name="device_name" placeholder="Device Name" class="input input-bordered" value="{{ $service_request->device_name }}" disabled>
                            <label class="label" for="device_description">Symptom or the damage information</label>
                            <textarea class="textarea textarea-bordered min-w-full" name="device_description" style="min-height:300px" placeholder="Input Symptom" disabled>{{ $service_request->device_description }}</textarea>
                            <label class="label">Quotations</label>
                            <div class="">
                            @if ($service_request->quotations != null)
                                <table class="table w-full">
                                    <thead>
                                        <th>ID</th>
                                        <th>Description</th>
                                        <th>Cost (RM)</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($service_request->quotations as $quotation)
                                            <tr>
                                                <td>{{ $quotation->id }}</td>
                                                <td>{{ $quotation->description }}</td>
                                                <td>{{ $quotation->cost }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">Total Cost</td>
                                            <td>{{ $service_request->quotations->sum() }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            @endif
                            </div>
                        </form>
                    </div>                      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
