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
                        @if (Auth::user()->hasRole('customer'))
                            <a href="{{ route('service_request.create') }}" class="btn mb-3">New</a> 
                        @endif
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>No</th> 
                                    <th>Device Name</th> 
                                    <th>Staff Approval</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @if ($service_requests !=null)
                                    @foreach ($service_requests as $service_request)
                                    <tr>
                                        <th>{{ $service_request->id }}</th> 
                                        <td>{{ $service_request->device_name }}</td> 
                                        <td>
                                            @if ($service_request->approval_status == 'waiting')
                                                Waiting Staff Approval
                                            @elseif ($service_request->approval_status == 'yes')
                                                Approved by Staff
                                            @elseif ($service_request->approval_status == 'no')
                                                Not Approved by Staff
                                            @endif
                                        </td> 
                                        <td><a class="btn btn-sm" href="{{ route('service_request.show', [$service_request]) }}">View</a></td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center text-xl" colspan="3">You have no request</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>                      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
