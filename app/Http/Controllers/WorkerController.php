<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkerRequest;
use App\Models\people;
use App\Models\Season;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->query('query');

        // Get workers with optional search
        $workers = People::where('role', 'worker')
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->get();

        return view('worker.index', compact('workers'));
    }


   /**
     * Show the form for adding a new daily wage record for the worker.
     */
    public function create($personId)
    {
        $person = people::findOrFail($personId); // Get the person (worker) by ID
        $seasons = Season::all();

        return view('worker.add', compact('person','seasons')); // Return view with person data
    }

    /**
     * Store the newly created daily wage record in the database.
     */
    public function store(StoreWorkerRequest $request, $personId)
    {
        // dd($personId);
        // Create a new worker record in the workers table
        Worker::create([
            'person_id' => $personId,
            'season_id' => $request->season_id,
            'daily_wage' => $request->daily_wage,
            'overtime_hours' => $request->overtime_hours ?? 0, // Default to 0 if not provided
            'created_at' => $request->date, // Use the provided date for created_at
        ]);
        $person=people::findOrFail($personId);
        $person->account_balance+=($request->daily_wage+ $request->overtime_hours );
        $person->update();


        return redirect()-> route('people.index', ['role' => 'worker'])->with('success', 'تم إضافة اليومية بنجاح');
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
