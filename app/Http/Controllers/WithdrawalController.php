<?php

namespace App\Http\Controllers;
use App\Models\UserBalance;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    //
    public function withdrawalview()
    {
        return view('withdrawal');
    }
    public function withdrawAmount(Request $request)
{
    $validator = Validator::make($request->all(), [
        'amount' => ['required', 'numeric', 'min:0'],
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $userId = Auth::id();
    $user = User::find($userId);

    $withdrawalAmount = $request->amount;
    $currentBalance = $user->balance ?? 0;

    // Check if the user has sufficient balance
    if ($withdrawalAmount > $currentBalance) {
        return redirect()->back()->withErrors('Insufficient balance');
    }

    // Calculate the new balance amount
    $newBalance = $currentBalance - $withdrawalAmount;

    // Update the user's balance
    $user->balance = $newBalance;
    $user->save();

    // Create a transaction record
    UserBalance::create([
        'user_id' => $userId,
        'from_id' => $userId,
        'amount' => $withdrawalAmount,
        'balance' => $newBalance,
        'type' => 'withdrawal',
        'tranfer_type' => 'debit',
        'date' => now(),
    ]);

    // Redirect or return a response as needed
     return redirect()->route('withdrwalfrom')->with('success', 'Withdrawal successful!');
}

}
