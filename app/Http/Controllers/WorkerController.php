<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkerRequest;
use App\Models\Payment;
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

        dd($workers);
        // // If there is a search query, filter companies by name
        // if ($query) {
        //     $workers = People::where('name', 'like', '%' . $query . '%')->get();
        // } else {
        //     $companies = People::all();
        // }

        return view('people.index', compact('workers'));
    }


    /**
     * Show the form for adding a new daily wage record for the worker.
     */
    public function create($personId)
    {
        $person = people::findOrFail($personId); // Get the person (worker) by ID
        $seasons = Season::all();

        return view('worker.add', compact('person', 'seasons')); // Return view with person data
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
        $person = people::findOrFail($personId);
        $person->account_balance += ($request->daily_wage + $request->overtime_hours);
        $person->update();


        return redirect()->route('people.index', ['role' => 'worker'])->with('success', 'تم إضافة اليومية بنجاح');
    }

    /**
     * Display the specified resource.
     */
    // WorkerController.php
    public function show($person_id)
    {
        // Retrieve the worker (person) by person_id
        $worker = People::findOrFail($person_id);

        // Retrieve related worker details (if any)
        $worker_details = Worker::where('person_id', $worker->id)->get();

        // Retrieve payments related to the worker (if applicable)
        $payments = Payment::where('person_id', $worker->id)->get();

        // Return the view with the data
        return view('worker.show', compact('worker', 'worker_details', 'payments'));
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
