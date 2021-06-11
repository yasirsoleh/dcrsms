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
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>No</th> 
                                    <th>Address</th> 
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @if ($deliveries !=null)
                                    @foreach ($deliveries as $delivery)
                                    <tr>
                                        <th>{{ $delivery->id }}</th> 
                                        <td>{{ $delivery->address }}</td> 
                                        <td>
                                            @if ($delivery->status == 'waiting_rider')
                                                Waiting Rider
                                            @elseif ($delivery->status == 'delivering')
                                                Delivering
                                            @elseif ($delivery->status == 'completed')
                                                Completed
                                            @elseif ($delivery->status == 'failed')
                                                Failed
                                            @endif
                                        </td> 
                                        <td>
                                            <a class="btn btn-sm" href="{{ route('delivery.show', ['delivery'=>$delivery]) }}">View</a>
                                            @if (Auth::user()->hasRole('rider'))
                                                @if ($delivery->status == 'waiting_rider')
                                                    <a class="btn btn-sm" href="{{ route('delivery.rider_accept', ['delivery'=>$delivery]) }}">Accept</a>
                                                @endif
                                                @if ($delivery->rider_id == Auth::user()->rider->id && $delivery->status != 'completed')
                                                    <a class="btn btn-sm" href="{{ route('delivery.edit', ['delivery'=>$delivery]) }}">Edit</a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center text-xl" colspan="3">You have no delivery</td>
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
