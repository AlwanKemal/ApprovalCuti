<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Leave;
use App\Models\Division;

class UserController extends Controller
{
    public function dashboard()
    {
        $leaves = Leave::where('user_id', auth()->id())->get();
        return view('user.dashboard', compact('leaves'));
    }

    public function applyLeave(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $user = auth()->user();
        $approver1 = User::where('role', 'approver1')->where('division_id', $user->division_id)->first();
        $approver2 = User::where('role', 'approver2')->where('division_id', $user->division_id)->first();

        Leave::create([
            'user_id' => $user->id,
            'approver1_id' => $approver1 ? $approver1->id : null,
            'approver2_id' => $approver2 ? $approver2->id : null,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status_approver1' => 'pending',
            'status_approver2' => 'pending',
        ]);

        return back();
    }
}
