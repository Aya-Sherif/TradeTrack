<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Models\Driver;
use App\Models\Payment;
use App\Models\people;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class DriverController extends Controller
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
    public function create($personId)
    {
        // Get all seasons for the dropdown
        $seasons = Season::all();
        $person = people::findOrFail($personId);
        // dd($person);
        // Return the form view with data
        $todayDate = Date::today();
        return view('driver.add', compact('person', 'seasons', 'todayDate'));
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreDriverRequest $request)
    {
        // The request is already validated at this point

        // Store the driver record
        $driver = people::findOrFail($request->person_id);
        $driver->account_balance += $request->fare;
        $driver->update();
        Driver::create($request->validated());

        // Redirect with a success message
        return redirect()->route('people.index', ['role' => 'driver'])->with('success', 'تم إضافة الرحلة بنجاح.');
    }


    /**
     * Display the specified resource.
     */
    // DriverController.php
    public function show($person_id)
    {
        // Fetch the driver's details
        $driver = people::findOrFail($person_id);

        // Fetch all trips related to this driver
        $trips = Driver::where('person_id', $person_id)->get();
        $payments = Payment::where('person_id', $driver->id)->get();

        return view('driver.show', compact('driver', 'trips','payments'));
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
