<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApproverController;
use App\Http\Controllers\UserController;

// Redirect halaman utama ke registrasi
Route::get('/', function () {
    return redirect()->route('register');
});

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    if (auth()->check()) {
        switch (auth()->user()->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'approver':
                return redirect()->route('approver1.dashboard');
            case 'approver2':
                return redirect()->route('approver2.dashboard');
            default:
                return redirect()->route('user.dashboard');
        }
    }
    return redirect()->route('auth.showLoginForm');
})->middleware('auth');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('user.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/leave/create', [LeaveController::class, 'create'])->name('leave.create');
    Route::post('/leave/store', [LeaveController::class, 'store'])->name('leave.store');
    Route::get('/leave/status', [LeaveController::class, 'status'])->name('leave.status');
});

Route::middleware(['auth', 'role:approver1'])->group(function () {
    Route::get('/approver/dashboard', [ApproverController::class, 'approver1Dashboard'])->name('approver1.dashboard');
    Route::put('/approver/approve/{id}', [ApproverController::class, 'approveByApprover1'])->name('approver.approve');
    Route::put('/approver/reject/{id}', [ApproverController::class, 'rejectByApprover1'])->name('approver.reject');
});

Route::middleware(['auth', 'role:approver2'])->group(function () {
    Route::get('/approver2/dashboard', [ApproverController::class, 'approver2Dashboard'])->name('approver2.dashboard');
    Route::put('/approver2/approve/{id}', [ApproverController::class, 'approveByApprover2'])->name('approver2.approve');
    Route::put('/approver2/reject/{id}', [ApproverController::class, 'rejectByApprover2'])->name('approver2.reject');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/update-role/{id}', [AdminController::class, 'updateUserRole'])->name('admin.updateRole');
    Route::post('/admin/add-division', [AdminController::class, 'addDivision'])->name('admin.addDivision');
});

