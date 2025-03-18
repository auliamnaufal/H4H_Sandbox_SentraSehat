<?php

use App\Livewire\Pages\DoctorQueue;
use App\Livewire\Pages\HealthFacilityReferral;
use App\Livewire\Pages\PatientQueue;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware('auth')
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('patient-queue', PatientQueue::class)->name('patient-queue');
    Route::get('doctor-queue', DoctorQueue::class)->name('doctor-queue');
    Route::get('health-facility-referral', HealthFacilityReferral::class)->name('health-facility-referral');
});

require __DIR__.'/auth.php';
