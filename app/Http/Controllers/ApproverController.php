<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;

class ApproverController extends Controller
{
    public function approver1Dashboard()
    {
        $leaves = Leave::where('approver1_id', Auth::id())
                        ->where('status_approver1', 'pending')
                        ->get();

        return view('approver.dashboard', compact('leaves'));
    }

    public function approver2Dashboard()
    {
        $leaves = Leave::where('approver2_id', Auth::id())
                        ->where('status_approver1', 'approved')
                        ->where('status_approver2', 'pending')
                        ->get();

        return view('approver2.dashboard', compact('leaves'));
    }

    public function approveByApprover1($id)
    {
        $leave = Leave::findOrFail($id);

        if ($leave->approver1_id !== Auth::id()) {
            return abort(403, 'Unauthorized action.');
        }

        $leave->update(['status_approver1' => 'approved']);

        return redirect()->route('approver1.dashboard')->with('success', 'Pengajuan cuti disetujui.');
    }

    public function rejectByApprover1($id)
    {
        $leave = Leave::findOrFail($id);

        if ($leave->approver1_id !== Auth::id()) {
            return abort(403, 'Unauthorized action.');
        }

        $leave->update(['status_approver1' => 'rejected', 'status_approver2' => 'rejected']);

        return redirect()->route('approver1.dashboard')->with('error', 'Pengajuan cuti ditolak.');
    }

    public function approveByApprover2($id)
    {
        $leave = Leave::findOrFail($id);

        if ($leave->approver2_id !== Auth::id()) {
            return abort(403, 'Unauthorized action.');
        }

        $leave->update(['status_approver2' => 'approved']);

        return redirect()->route('approver2.dashboard')->with('success', 'Pengajuan cuti disetujui.');
    }

    public function rejectByApprover2($id)
    {
        $leave = Leave::findOrFail($id);

        if ($leave->approver2_id !== Auth::id()) {
            return abort(403, 'Unauthorized action.');
        }

        $leave->update(['status_approver2' => 'rejected']);

        return redirect()->route('approver2.dashboard')->with('error', 'Pengajuan cuti ditolak.');
    }
}