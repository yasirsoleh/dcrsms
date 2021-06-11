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
                        <label class="label" for="id">Delivery ID</label>
                        <input type="text" name="id" placeholder="Delivery ID" class="input input-bordered" value="{{ $delivery->id }}" disabled>
                        <label class="label" for="address">Address</label>
                        <textarea class="textarea textarea-bordered min-w-full" name="address" style="min-height:100px" placeholder="Address" disabled>{{ $delivery->address }}</textarea>
                        <label class="label" for="status">Status</label>
                        @if ($delivery->status == 'waiting_rider')
                            <span>Waiting Rider</span>
                        @elseif ($delivery->status == 'delivering')
                            <span>Delivering</span>
                        @elseif ($delivery->status == 'completed')
                            <span>Completed</span>
                        @elseif ($delivery->status == 'failed')
                            <span>Failed</span>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
