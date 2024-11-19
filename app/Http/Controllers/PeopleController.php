<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Models\people;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get query parameters
        $role = $request->query('role');  // Role filter: 'worker', 'driver', or null
        $query = $request->query('query');  // Search filter

        // Query the People model
        $people = People::when($role, function ($q) use ($role) {
                // Apply role filter if provided
                $q->where('role', $role);
            })
            ->when($query, function ($q) use ($query) {
                // Apply search filter if provided
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->get();
// dd($request);
        // Return the view with the filtered list
        return view('people.index', compact('people', 'role'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $role=$request->query('role');
        // dd($role);
        // Return the view for creating a new person (worker)
        return view('people.create',compact('role'));
    }

    /**
     * Store a newly created person (worker) in storage.
     */
    public function store(StorePersonRequest $request)
{
    // Validate the role field if included
    $validated = $request->validated();

    // dd($request);
    // Default role is 'worker' if none is provided
    $role = $request->input('role', 'worker');
    // Ensure the role is either 'worker' or 'driver'
    if (!in_array($role, ['worker', 'driver'])) {
        return redirect()->back()->withErrors(['role' => 'Invalid role specified']);
    }

    // Store the new person in the people table
    $person = People::create([
        'name' => $validated['name'],
        'role' => $role, // Dynamically set the role
        'account_balance' => 0, // Default balance for a new person
    ]);

    // Redirect to the appropriate index with success message
    return redirect()->route('people.index', ['role' => $role])->with('success', 'تم إضافة ' . ($role == 'worker' ? 'العامل' : 'السائق') . ' بنجاح');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
