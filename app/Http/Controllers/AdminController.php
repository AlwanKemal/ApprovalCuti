<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Division;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::all();
        $divisions = Division::all();
        return view('admin.dashboard', compact('users', 'divisions'));
    }

    public function updateUserRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'role' => 'required|in:admin,approver1,approver2,user',
            'division_id' => 'nullable|exists:divisions,id',
        ]);

        if (in_array($request->role, ['admin', 'user'])) {
            $user->update([
                'role' => $request->role,
                'division_id' => $request->division_id, 
            ]);
            return redirect()->route('admin.dashboard')->with('success', 'Role dan divisi user berhasil diperbarui.');
        }

        $existingApprover1 = User::where('division_id', $request->division_id)->where('role', 'approver1')->exists();
        $existingApprover2 = User::where('division_id', $request->division_id)->where('role', 'approver2')->exists();

        if ($request->role === 'approver1') {
            if ($existingApprover2 && !$existingApprover1) {
                $user->update([
                    'role' => 'approver1',
                    'division_id' => $request->division_id,
                ]);
                return redirect()->route('admin.dashboard')->with('success', 'User berhasil diubah menjadi Approver 1.');
            } elseif ($existingApprover1) {
                return redirect()->back()->with('error', 'Approver 1 di divisi ini sudah ada.');
            }
        }

        if ($request->role === 'approver2') {
            if ($existingApprover1 && !$existingApprover2) {
                $user->update([
                    'role' => 'approver2',
                    'division_id' => $request->division_id,
                ]);
                return redirect()->route('admin.dashboard')->with('success', 'User berhasil diubah menjadi Approver 2.');
            } elseif ($existingApprover2) {
                return redirect()->back()->with('error', 'Approver 2 di divisi ini sudah ada.');
            }
        }

        return redirect()->back()->with('error', 'Perubahan role tidak memenuhi syarat.');
    }

    public function addDivision(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:divisions,name'
        ]);

        Division::create(['name' => $request->name]);

        return redirect()->route('admin.dashboard')->with('success', 'Divisi berhasil ditambahkan.');
    }
}

