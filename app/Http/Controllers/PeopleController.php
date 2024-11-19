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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new person (worker)
        return view('people.create');
    }

    /**
     * Store a newly created person (worker) in storage.
     */
    public function store(StorePersonRequest $request)
    {
        // Store the new person in the people table
        $person = people::create([
            'name' => $request->name,
            'role' => 'worker', // This will set the role to 'worker' by default
            'account_balance' => 0, // Default balance for a new worker
        ]);

        // Redirect back with success message
        return redirect()->route('workers.index')->with('success', 'تم إضافة العامل بنجاح');
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
