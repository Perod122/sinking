<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sinking Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-2">Back to Dashboard</a>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="text-lg font-semibold">Sinking Record Details</h3>
                        <!-- Add Member Button -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                            Add Member
                        </button>
                    </div>
                    <ul class="mt-4">
                        <li><strong>Start Date:</strong>{{ \Carbon\Carbon::parse($sinking->dateStart)->format('F j, Y') }}</li>
                        <li><strong>End Date:</strong> {{ \Carbon\Carbon::parse($sinking->dateEnd)->format('F j, Y') }}</li>
                        <li><strong>Payment:</strong> {{ ucwords(strtolower($sinking->method)) }}</li>
                        <li><strong>Payment:</strong> {{ $sinking->payment }}</li>
                    </ul>

                    <h4 class="mt-6 mb-3">Members</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th> 
                                <th>Count</th>
                                <th>Member Name</th> <!-- Updated Header -->
                                <th>Required Payment</th>
                                <th>Total Contribution</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($sinking->members->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">No members yet</td>
                            </tr>
                        @else
                                @foreach ($sinking->members as $member)
                                    <tr>
                                        <td>{{ $member->MemID }}</td>
                                        <td>{{ $member->count }}</td>
                                        <td>{{ ucwords(strtolower($member->fName)) }} {{ ucwords(strtolower($member->lName)) }}</td> <!-- Merged Name Column -->
                                        <td>P{{ number_format($member->count * $sinking->payment, 2) }} {{ ucwords(strtolower($sinking->method)) }}</td> <!-- Required Payment -->
                                        <td>P{{ number_format($member->contributions_sum_amount ?? 0, 2) }}</td> <!-- Total Contributions -->
                                        <td>
                                            <!-- View Button (No Form) -->
                                            <button type="button" class="btn btn-info btn-m" onclick="window.location='{{ route('sinking.viewContributions', [$sinking->SinkID, $member->MemID]) }}'">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            
                                            <!-- Remove Member Form -->
                                            <form action="{{ route('sinking.removeMember', ['SinkID' => $sinking->SinkID, 'memberID' => $member->MemID]) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this member?');" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-m"><i class="fas fa-trash-alt"></i></button>
                                            </form>
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

    <!-- Add Member Modal -->
    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMemberModalLabel">Add Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('sinking.addMember', $sinking->SinkID) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="fName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="fName" name="fName" required>
                        </div>
                        <div class="mb-3">
                            <label for="lName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lName" name="lName" required>
                        </div>
                        <div class="mb-3">
                            <label for="count" class="form-label">Count</label>
                            <input type="number" class="form-control" id="count" name="count" required min="0">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
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
