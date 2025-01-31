<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Add Sinking Data Button -->
                    <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addSinkingModal">
                        Add Sinking Data
                    </button>

                    <!-- Sinking Data Table -->
                    <table class="table mt-4 table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Members</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($sinkingData->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">No sinking yet</td>
                            </tr>
                        @else
                            @foreach ($sinkingData as $sinking)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($sinking->dateStart)->format('F j, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sinking->dateEnd)->format('F j, Y') }}</td>
                                    <td>P{{ $sinking->payment }}</td>
                                    <td>{{ ucfirst($sinking->method) }}</td>
                                    <td>{{ $sinking->members_count }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-info btn-sm" onclick="window.location='{{ route('sinking.show', $sinking->SinkID) }}'">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <form action="{{ route('sinking.destroy', $sinking->SinkID) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this sinking record?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Sinking Data Modal -->
    <div class="modal fade" id="addSinkingModal" tabindex="-1" aria-labelledby="addSinkingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSinkingModalLabel">Add Sinking Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('sinking.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="dateStart" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="dateStart" name="dateStart" required>
                    </div>
                    <div class="mb-3">
                        <label for="dateEnd" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="dateEnd" name="dateEnd" required>
                    </div>
                    <div class="mb-3">
                        <label for="method" class="form-label">Payment Method</label>
                        <select class="form-control" id="method" name="method" required>
                            <option value="daily">Daily</option>
                            <option value="weekly" selected>Weekly</option>
                            <option value="monthly">Monthly</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="payment" class="form-label">Payment</label>
                        <input type="number" class="form-control" id="payment" name="payment" required min="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            @if (session('success'))
                <script>
                    Swal.fire({
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif
        </div>
    </div>
</div>

</x-app-layout>
