<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pick Up') }}
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
                                @if ($pick_ups !=null)
                                    @foreach ($pick_ups as $pick_up)
                                    <tr>
                                        <th>{{ $pick_up->id }}</th> 
                                        <td>{{ $pick_up->address }}</td> 
                                        <td>
                                            @if ($pick_up->customer_approval == 'waiting_rider')
                                                Waiting Rider
                                            @elseif ($pick_up->customer_approval == 'picking_up')
                                                Picking Up
                                            @elseif ($pick_up->customer_approval == 'completed')
                                                Completed
                                            @elseif ($pick_up->customer_approval == 'failed')
                                                Failed
                                            @endif
                                        </td> 
                                        <td>
                                            <a class="btn btn-sm" href="{{ route('pick_up.show', ['pick_up'=>$pick_up]) }}">View</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center text-xl" colspan="3">You have no quotation</td>
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
