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
                            <label class="label" for="device_name">Device Name</label>
                            <input type="text" name="device_name" placeholder="Device Name" class="input input-bordered" value="{{ $service_request->device_name }}" disabled>
                            <label class="label">Quotations</label>
                            <div class="">
                            @if ($service_request->quotations != null)
                                <table class="table w-full">
                                    <thead>
                                        <th>ID</th>
                                        <th>Description</th>
                                        <th>Cost (RM)</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($service_request->quotations as $quotation)
                                            <tr>
                                                <td>{{ $quotation->id }}</td>
                                                <td>{{ $quotation->description }}</td>
                                                <td>{{ $quotation->cost }}</td>
                                                <td>
                                                    @if ($service_request->customer_approval == null && Auth::user()->hasRole('staff'))
                                                        <form action="{{ route('quotation.delete', ['quotation'=>$quotation]) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf                                       
                                                            <input class="btn btn-sm" type="submit" value="Delete">
                                                        </form> 
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tbody class="font-bold">
                                        <tr>
                                            <td colspan="2">Total Cost</td>
                                            <td>{{ $service_request->quotations->sum('cost') }}</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                            </div>
                            @if (Auth::user()->hasRole('staff') && $service_request->customer_approval == null)
                                <a class="btn mt-3" href="{{ route('quotation.create', ['service_request'=>$service_request]) }}">Add Quotation</a>
                            @elseif (Auth::user()->hasRole('customer') && $service_request->customer_approval == null)
                                <a class="btn" href="{{ route('service_request.customer_approve', ['service_request'=>$service_request]) }}">Accept</a>
                                <a class="btn" href="{{ route('service_request.customer_not_approve', ['service_request'=>$service_request]) }}">Reject</a>
                            @endif
                    </div>                      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
