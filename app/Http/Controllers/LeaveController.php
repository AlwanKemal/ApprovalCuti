<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function create()
    {
        return view('user.leave_request');
    }
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $user = Auth::user();

        $approver1 = User::where('division_id', $user->division_id)->where('role', 'approver1')->first();
        $approver2 = User::where('division_id', $user->division_id)->where('role', 'approver2')->first();

        Leave::create([
            'user_id' => $user->id,
            'division_id' => $user->division_id,
            'approver1_id' => $approver1 ? $approver1->id : null,
            'approver2_id' => $approver2 ? $approver2->id : null,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status_approver1' => 'pending',
            'status_approver2' => 'pending',
        ]);

        return redirect()->route('leave.status')->with('success', 'Pengajuan cuti berhasil dikirim.');
    }
    public function status()
    {
        $leaves = Leave::where('user_id', Auth::id())->get();
        return view('user.leave_status', compact('leaves'));
    }

    public function approve(Request $request, Leave $leave)
    {
        if (auth()->user()->role == 'approver') {
            $leave->update(['status_approver1' => $request->status]);

            if ($request->status == 'rejected') {
                $leave->update(['status_approver2' => 'rejected']);
            }
        } elseif (auth()->user()->role == 'approver2' && $leave->status_approver1 == 'approved') {
            $leave->update(['status_approver2' => $request->status]);
        }

        return back()->with('success', 'Status pengajuan cuti diperbarui.');
    }
}

