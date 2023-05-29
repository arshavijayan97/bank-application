<?php

namespace App\Http\Controllers;
use App\Models\UserBalance;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    //
    public function depositview()
    {
        return view('deposit');
    }
    public function deposit(Request $request)
{
	$validator = Validator::make($request->all(), [
        'amount' => ['required', 'numeric', 'min:1'],
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

	$userId = Auth::id();
	$user = User::find($userId);

    $depositAmount = $request->amount;
    $currentBalance = $user->balance ?? 0; // If user balance is null, default to 0

    // Calculate the new balance amount
    $newBalance = $currentBalance + $depositAmount;

    // Update the user's balance
    $user->balance = $newBalance;
    $user->save();
    // Retrieve the amount from the request
    UserBalance::create([
        'user_id' => $userId, 
        'amount' => $request->amount,
        'from_id' => $userId,
        'balance' => $newBalance, 
        'type' => 'deposit',
        'tranfer_type' => 'credit',
        'date' => now(),
    ]);
    
    // Perform the necessary logic to update the user's balance with the deposited amount
    
    // Redirect back to the home page with a success message
    return redirect()->route('depositfrom')->with('success', 'Deposit successful!');
}

}
