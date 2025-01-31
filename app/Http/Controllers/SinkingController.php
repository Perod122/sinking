<?php

namespace App\Http\Controllers;

use App\Models\Sinking;
use App\Models\SinkMember;
use Illuminate\Http\Request;

class SinkingController extends Controller
{
    
    // Show the form for creating sinking data (if needed)
    public function create()
    {
        return view('sinking.create');
    }

    // Store sinking data
    public function store(Request $request)
{
    $validated = $request->validate([
        'dateStart' => 'required|date',
        'dateEnd' => 'required|date',
        'payment' => 'required|integer',
        'method' => 'required|string' 
    ]);

    // Ensure user is authenticated before creating a record
    $user = auth()->user();
    if (!$user) {
        return redirect()->back()->with('error', 'You must be logged in to create sinking data.');
    }

    Sinking::create([
        'ownerID' => $user->userID, // Assign logged-in user's ID
        'dateStart' => $validated['dateStart'],
        'dateEnd' => $validated['dateEnd'],
        'payment' => $validated['payment'],
        'method' => $validated['method']
    ]);

    return redirect()->back()->with('success', 'Sinking data added successfully!');
}





    // Optional: Display sinking data
    public function index()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in.');
        }

        // Get sinking data only for the logged-in user
        $sinkingData = Sinking::where('ownerID', $user->userID)->withCount('members')->get();

        return view('dashboard', compact('sinkingData'));
    }


    public function show($id)
    {
        // Find the sinking record with members and contributions sum
        $sinking = Sinking::with(['members' => function ($query) {
            $query->withSum('contributions', 'amount'); // Sum contributions
        }])->findOrFail($id);
    
        // Calculate the total accumulated money from all members
        $totalAccumulated = $sinking->members->sum('contributions_sum_amount');
    
        return view('sinking.show', compact('sinking', 'totalAccumulated'));
    }
    public function addMember(Request $request, $id)
    {
        $request->validate([
            'fName' => 'required|string|max:50',
            'lName' => 'required|string|max:50',
            'count' => 'required|integer|min:0',
        ]);
    
        SinkMember::create([
            'sinkMemID' => $id,
            'fName' => $request->fName,
            'lName' => $request->lName,
            'count' => $request->count,
        ]);
    
        return redirect()->route('sinking.show', $id)->with('success', 'Member added successfully!');
    }
    public function removeMember($SinkID, $memberID)
        {
            // Find the sinking record by SinkID
            $sinking = Sinking::findOrFail($SinkID);

            // Find the member and remove them from the sinking (assuming it's a has-many relationship)
            $member = $sinking->members()->where('MemID', $memberID)->firstOrFail();

            // Delete the member record from the database
            $member->delete();  // This will delete the member from the database

            // Redirect back to the sinking page with a success message
            return redirect()->route('sinking.show', $SinkID)
                ->with('success', 'Member removed successfully.');
        }

        public function destroy($SinkID)
        {
            // Find the sinking record
            $sinking = Sinking::findOrFail($SinkID);

            // Delete the sinking record
            $sinking->delete();

            return redirect()->back()->with('success', 'Sinking removed successfully!');
        }

}
