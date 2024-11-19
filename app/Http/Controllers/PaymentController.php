<?php
// app/Http/Controllers/PaymentController.php
namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\People;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create($person_id)
    {
        // Get the person (worker or driver)
        $person = People::findOrFail($person_id);

        // Return a view where payment details can be entered
        return view('payments.add', compact('person'));
    }

    public function store(Request $request, $person_id)
    {
        // Validate the payment data
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // Find the person (worker or driver)
        $person = People::findOrFail($person_id);

        // Create the payment record
        Payment::create([
            'person_id' => $person_id,
            'amount' => $request->amount,
            'role' => $person->role, // Role could be either 'worker' or 'driver'
            'created_at'=>$request->date,
        ]);

        // Optionally, update the account balance if necessary
        $person->account_balance -= $request->amount;
        $person->save();

        // Redirect with success message
        return redirect()->route( 'people.index', ['role' => $person->role])->with('success', 'تم دفع المبلغ بنجاح');
    }
}
