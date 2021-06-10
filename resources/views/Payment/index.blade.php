<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment') }}
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
                                    <th>Service Request ID</th> 
                                    <th>Amount</th> 
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead> 
                            <tbody>
                                @if ($payments !=null)
                                    @foreach ($payments as $payment)
                                    <tr>
                                        <th>{{ $payment->service_request_id }}</th> 
                                        <td>{{ $payment->amount }}</td> 
                                        <td>{{ $payment->status }}</td>
                                        <td>
                                            @if ($payment->status != 'received' && Auth::user()->hasRole('customer'))
                                                <a class="btn btn-sm" href="{{ route('payment.edit', ['payment'=> $payment]) }}">Pay</a></td>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center text-xl" colspan="4">You have no payment</td>
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
