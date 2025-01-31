<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contribution;
use App\Models\SinkMember;
use App\Models\Sinking;

class ContributionController extends Controller
{
    // View contributions
    public function viewContributions($SinkID, $MemID)
        {
            // Fetch the sinking record
            $sinking = Sinking::findOrFail($SinkID);

            // Fetch the member record
            $member = $sinking->members()->where('MemID', $MemID)->firstOrFail();

            // Fetch contributions for the member
            $contributions = $member->contributions;

            return view('contributions.view', compact('sinking', 'member', 'contributions'));
        }

    // Add a new contribution
    public function addContribution(Request $request, $SinkID, $memberID)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);
    
        Contribution::create([
            'contriMemID' => $memberID, // Use the correct column name here
            'amount' => $request->amount,
            'datepaid' => now(),
        ]);
    
        return redirect()->route('sinking.viewContributions', ['SinkID' => $SinkID, 'member' => $memberID])
                         ->with('success', 'Contribution added successfully.');
    }

    // Delete a contribution
    public function removeContribution($SinkID, $memberID, $contriID)
    {
        // Find and delete the contribution
        $contribution = Contribution::where('contriID', $contriID)
                                    ->where('contriMemID', $memberID)
                                    ->firstOrFail();

        $contribution->delete();

        return redirect()->route('sinking.viewContributions', ['SinkID' => $SinkID, 'member' => $memberID])
                        ->with('success', 'Contribution removed successfully.');
    }

}