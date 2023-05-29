<?php

namespace App\Http\Controllers;
use App\Models\UserBalance;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class TransferController extends Controller
{
    //
    public function showTransferForm()
    {
        return view('transfer');
    }
     public function transfer(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
    'recipient_email' => 'required|email|exists:users,email',
    'amount' => 'required|numeric|min:0',
     ]);

        // Retrieve the recipient's email and amount from the validated data
        $recipientEmail = $validatedData['recipient_email'];
        $amount = $validatedData['amount'];

        // Get the logged-in user's ID
        $senderId = auth()->id();

        // Check if the recipient email exists
        $recipient = User::where('email', $recipientEmail)->first();
        // $recipient_user = UserBalance::where('user_id', $recipient->id)->latest()->first();
     

        if (!$recipient) {
            throw ValidationException::withMessages([
                'recipient_email' => 'The recipient email does not exist.',
            ]);
        }

        // Check if the sender has enough balance
        $sender = User::findOrFail($senderId);
       

        if ($sender->balance < $amount) {
            throw ValidationException::withMessages([
                'amount' => 'Insufficient balance.',
            ]);
        }
        $sender_newBalance = $sender->balance - $amount;
        $receiver_newBalance = $recipient->balance + $amount;

        // Perform update balnce users table
        $sender->balance -= $amount;
        $sender->save();

        $recipient->balance += $amount;
        $recipient->save();

       // Insert sender's transaction record
       UserBalance::create([
        'user_id' => $senderId, 
        'amount' => $request->amount,
        'from_id' => $recipient->id,
        'balance' => $sender_newBalance, 
        'type' => 'transfer',
        'tranfer_type' => 'debit',
        'date' => now(),
    ]);

      // Insert recipient's transaction record
      UserBalance::create([
        'user_id' => $recipient->id, 
        'amount' => $request->amount,
        'from_id' => $senderId,
        'balance' => $receiver_newBalance, 
        'type' => 'transfer',
        'tranfer_type' => 'credit',
        'date' => now(),
    ]);

        // Redirect back to the transfer form with a success message
        return redirect()->route('transferfrom')->with('success', 'Transfer completed successfully.');
    }


}
