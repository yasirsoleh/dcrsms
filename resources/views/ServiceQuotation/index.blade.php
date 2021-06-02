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
                                    <th>Approval</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @if ($service_requests !=null)
                                    @foreach ($service_requests as $item)
                                    <tr>
                                        <th>{{ $item->id }}</th> 
                                        <td>{{ $item->device_name }}</td> 
                                        <td>{{ $item->approval_status }}</td> 
                                        <td><a class="btn btn-sm" href="service_request/{{ $item->id }}">View</a>
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
