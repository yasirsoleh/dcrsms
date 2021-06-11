<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account') }}
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
                                    <th>Rider ID</th> 
                                    <th>Fist Name</th> 
                                    <th>Last Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @if ($riders !=null)
                                    @foreach ($riders as $rider)
                                    <tr>
                                        <th>{{ $rider->id }}</th> 
                                        <td>{{ $rider->first_name }}</td> 
                                        <td>{{ $rider->last_name }}</td>
                                        <td>{{ $rider->status }}</td>
                                        <td>
                                            @if ($rider->status == 'not_approved')
                                                <a class="btn btn-sm" href="{{ route('account.rider_aprove', ['rider'=> $rider]) }}">Approve</a></td>
                                            @else
                                                @if ($rider->status == 'not_banned')
                                                    <a class="btn btn-sm" href="{{ route('account.rider_ban', ['rider'=> $rider]) }}">Ban</a></td>
                                                @elseif ($rider->status == 'banned')
                                                    <a class="btn btn-sm" href="{{ route('account.rider_ban', ['rider'=> $rider]) }}">Unban</a></td>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center text-xl" colspan="5">No Riders</td>
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
