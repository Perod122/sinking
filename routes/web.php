<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SinkingController;
use App\Http\Controllers\ContributionController;

Route::get('/', function () {
    return view('welcome');
});

// Routes that require login and verification
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard', [SinkingController::class, 'index'])->name('dashboard');

    Route::post('/sinking/store', [SinkingController::class, 'store'])->name('sinking.store');
    Route::get('/sinking/create', [SinkingController::class, 'create'])->name('sinking.create');
    Route::get('/sinking/{id}', [SinkingController::class, 'show'])->name('sinking.show');
    Route::post('/sinking/{id}/add-member', [SinkingController::class, 'addMember'])->name('sinking.addMember');
    Route::post('/sinking/{SinkID}/add-member', [SinkingController::class, 'addMember'])->name('sinking.addMember');
    Route::delete('/sinking/{SinkID}/remove-member/{memberID}', [SinkingController::class, 'removeMember'])->name('sinking.removeMember');

    Route::delete('/sinking/{SinkID}', [SinkingController::class, 'destroy'])->name('sinking.destroy');


    Route::post('/sinking/{SinkID}/contribution/{memberID}', [ContributionController::class, 'addContribution'])->name('sinking.addContribution');
    Route::get('/sinking/{SinkID}/{member}/view-contributions', [ContributionController::class, 'viewContributions'])->name('sinking.viewContributions');
    Route::delete('/sinking/{SinkID}/member/{memberID}/contribution/{contriID}', 
        [ContributionController::class, 'removeContribution']
    )->name('sinking.removeContribution');
});

// Profile-related routes (auth required)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
