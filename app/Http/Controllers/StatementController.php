<?php

namespace App\Http\Controllers;

use App\Models\UserBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatementController extends Controller
{
    public function statements()
    {
    	
        $userId = Auth::id();
        $statements = UserBalance::where('user_id', $userId)
            ->orderBy('created_at', 'asc')
            ->paginate(2);
        return view('statement', compact('statements'));
    }
}

