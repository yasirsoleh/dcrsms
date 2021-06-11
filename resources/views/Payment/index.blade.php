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
                        @if (session()->has('success_message'))
                            <div class="spacer"></div>
                            <div class="alert alert-success">
                                {{ session()->get('success_message') }}
                            </div>
                        @endif
                    
                        @if (count($errors) > 0)
                            <div class="spacer"></div>
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{!! $error !!}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>Service Request ID</th> 
                                    <th>Amount</th> 
                                    <th>Status</th>
                                    <th>Pay</th>
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
                                            @if ($payment->status != 'received' && Auth::user()->hasRole('customer') && $payment->type != 'cash_on_delivery')
                                                <a class="btn btn-sm" href="{{ route('payment.edit', ['payment'=> $payment]) }}">Online</a>
                                            @endif
                                            @if (Auth::user()->hasRole('customer') && $payment->type != 'online')
                                                @if ($payment->type != 'cash_on_delivery')
                                                <a class="btn btn-sm" href="{{ route('payment.cash_on_delivery', ['payment'=> $payment]) }}">Cash on Delivery</a>
                                                @endif
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
