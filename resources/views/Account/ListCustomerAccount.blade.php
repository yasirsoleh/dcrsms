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
                        <table class="table w-full" id="myTable2">
                            <thead>
                                <tr>
                                    <th>Cusomter ID</th> 
                                    <th>Fist Name</th> 
                                    <th>Last Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @if ($customers !=null)
                                    @foreach ($customers as $customer)
                                    <tr>
                                        <th>{{ $customer->id }}</th> 
                                        <td>{{ $customer->first_name }}</td> 
                                        <td>{{ $customer->last_name }}</td>
                                        <td>{{ $customer->status }}</td>
                                        <td>
                                            @if ($customer->status == 'not_banned')
                                                <a class="btn btn-sm" href="{{ route('account.customer_ban', ['customer'=> $customer]) }}">Ban</a>
                                            @else
                                                <a class="btn btn-sm" href="{{ route('account.customer_unban', ['customer'=> $customer]) }}">Unban</a>
                                            @endif
                                            <a class="btn btn-sm" href="{{ route('account.destroy_customer', ['customer'=> $customer]) }}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center text-xl" colspan="5">No Customer</td>
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
