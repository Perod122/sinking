<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contributions of ') . ucwords(strtolower($member->fName)) . ' ' . ucwords(strtolower($member->lName)) }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('sinking.show', $sinking->SinkID) }}" class="btn btn-secondary mb-2">Back</a>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h4>Contributions</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($contributions->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center">
                                    <p class="text-muted">No contributions yet</p>
                                </td>
                            </tr>
                        @else
                            @foreach ($contributions as $contribution)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($contribution->datepaid)->format('F j, Y') }}</td>
                                    <td>P{{ $contribution->amount }}</td>
                                    <td class="text-right">
                                        <form action="{{ route('sinking.removeContribution', ['SinkID' => $sinking->SinkID, 'memberID' => $member->MemID, 'contriID' => $contribution->contriID]) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this contribution?');">
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
                <!-- Add Contribution Button -->
                <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#addContributionModal">
                    Add Contribution
                </button>
            </div>
        </div>
    </div>
</div>


    <!-- Add Contribution Modal -->
    <div class="modal fade" id="addContributionModal" tabindex="-1" aria-labelledby="addContributionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addContributionModalLabel">Add Contribution</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if (!$sinking || !$member)
                    <div class="alert alert-danger">
                        Sinking or Member data is missing!
                    </div>
                @else
                <form action="{{ route('sinking.addContribution', ['SinkID' => $sinking->SinkID, 'memberID' => $member->MemID]) }}" method="POST">

                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input class="form-control" id="amount" name="amount" required min="0">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>