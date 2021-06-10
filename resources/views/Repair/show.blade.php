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
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form action="{{ route('repair.store') }}" method="POST">
                            @csrf
                            <label class="label" for="device_name">Device Name</label>
                            <input type="text" name="device_name" placeholder="Device Name" class="input input-bordered" value="{{ $repair->service_request->device_name }}" disabled>
                            <div class="">
                            @if ($repair->repair_items != null)
                            <label class="label">Repair Cost</label>
                                <table class="table w-full">
                                    <thead>
                                        <th>ID</th>
                                        <th>Description</th>
                                        <th>Cost (RM)</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($repair->repair_items as $repair_item)
                                            <tr>
                                                <td>{{ $repair_item->id }}</td>
                                                <td>{{ $repair_item->description }}</td>
                                                <td>{{ $repair_item->cost }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tbody class="font-bold">
                                        <tr>
                                            <td colspan="2">Total Cost</td>
                                            <td>{{ $repair->repair_items->sum('cost') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                            </div>
                        </form>
                    </div>                      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
