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
                        <label class="label" for="id">Pick Up ID</label>
                        <input type="text" name="id" placeholder="Pick Up ID" class="input input-bordered" value="{{ $pick_up->id }}" disabled>
                        <label class="label" for="address">Address</label>
                        <textarea class="textarea textarea-bordered min-w-full" name="address" style="min-height:100px" placeholder="Address" disabled>{{ $pick_up->address }}</textarea>
                        <label class="label" for="status">Status</label>
                        @if ($pick_up->status == 'waiting_rider')
                            <span>Waiting Rider</span>
                        @elseif ($pick_up->status == 'picking_up')
                            <span>Picking Up</span>
                        @elseif ($pick_up->status == 'completed')
                            <span>Completed</span>
                        @elseif ($pick_up->status == 'failed')
                            <span>Failed</span>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
