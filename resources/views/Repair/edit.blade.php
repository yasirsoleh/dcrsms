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
                        <label class="label" for="device_name">Device Name</label>
                        <input type="text" name="device_name" placeholder="Device Name" class="input input-bordered" value="{{ $repair->service_request->device_name }}" disabled>
                        <label class="label" for="device_name">Description</label>
                        <textarea class="textarea textarea-bordered min-w-full" name="device_description" style="min-height:100px" placeholder="Input Symptom" disabled>{{ $repair->service_request->device_description }}</textarea>
                        <label class="label" for="device_name">Status</label>
                        <form action="{{ route('repair.update', ['repair'=>$repair]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            @if ($repair->status != 'repaired')
                                <select class="select select-bordered w-full max-w-xs" name="status">
                                    <option value="pending" {{ ( $repair->status == 'pending') ? 'selected' : '' }}> 
                                        Pending
                                    </option>
                                    <option value="on_progress" {{ ( $repair->status == 'on_progress') ? 'selected' : '' }}> 
                                        On Progress
                                    </option>
                                    <option value="repaired" {{ ( $repair->status == 'repaired') ? 'selected' : '' }}> 
                                        Repaired
                                    </option>
                                    <option value="cannot_be_repaired" {{ ( $repair->status == 'cannot_be_repaired') ? 'selected' : '' }}> 
                                        Cannot Be Repaired
                                    </option>
                                </select>
                                <input class="btn" type="submit" value="Save">
                            @else
                            <input type="text" name="status" placeholder="Status" class="input input-bordered" value="Repaired" disabled>
                            @endif
                        </form>
                        <label class="label mt-3">Repair Cost</label>
                        <div class="">
                        @if ($repair->repair_items != null)
                            <table class="table w-full">
                                <thead>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Cost (RM)</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($repair->repair_items as $repair_item)
                                        <tr>
                                            <td>{{ $repair_item->id }}</td>
                                            <td>{{ $repair_item->description }}</td>
                                            <td>{{ $repair_item->cost }}</td>
                                            <td>
                                                @if ($repair->status != 'repaired' && $repair->status != 'cannot_be_repaired')
                                                    <form action="{{ route('repair.destroy_item', ['repair_item'=>$repair_item]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input class="btn btn-sm" type="submit" value="Delete">
                                                    </form>
                                                @endif
                                            </td>
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
                        @if (Auth::user()->hasRole('staff') && $repair->status != 'repaired')
                            <a class="btn mt-3" href="{{ route('repair.add_item', ['repair'=>$repair]) }}">Add Item</a>
                        @endif
                    </div>                      
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
