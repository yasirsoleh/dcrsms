<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Repair') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="table w-full" id="myTable">
                            <thead>
                                <tr>
                                    <th>Service Request ID</th>
                                    <th>Name</th> 
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @if ($repairs !=null)
                                    @foreach ($repairs as $repair)
                                    <tr>
                                        <td>{{ $repair->service_request->id }}</td>
                                        <td>{{ $repair->service_request->device_name }}</td> 
                                        <td>
                                            @if ($repair->status == 'pending')
                                                Pending
                                            @elseif ($repair->status == 'on_progress')
                                                On Progress
                                            @elseif ($repair->status == 'repaired')
                                                Repaired
                                            @elseif ($repair->status == 'cannot_be_repaired')
                                                Cannot be Repaired
                                            @endif
                                        </td> 
                                        <td>
                                            <a class="btn btn-sm" href="{{ route('repair.show', ['repair'=>$repair]) }}">View</a>
                                            @if (Auth::user()->hasRole('staff') && $repair->status != 'repaired' && $repair->status != 'cannot_be_repaired')
                                                <a class="btn btn-sm" href="{{ route('repair.edit', ['repair'=>$repair]) }}">Edit</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center text-xl" colspan="4">You have no repair</td>
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
