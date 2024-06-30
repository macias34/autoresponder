<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResponseManagementController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('emails', EmailController::class);
    Route::post('emails/{email}/generate-response', [EmailController::class, 'generateResponse'])
        ->name('emails.generate-response');
    Route::post('emails/{email}/answer', [EmailController::class, 'answer'])
        ->name('emails.answer');

    Route::get('/response-management', [ResponseManagementController::class, 'index'])->name('response-management.index');
    Route::patch('/response-management/prompt',
        [ResponseManagementController::class, 'updatePrompt'])
        ->name('response-management.update-prompt');
    Route::patch('/response-management/toggle-auto-generation',
        [ResponseManagementController::class, 'toggleAutoGeneration'])
        ->name('response-management.toggle-auto-generation');
    Route::patch('/response-management/toggle-auto-answered',
        [ResponseManagementController::class, 'toggleAutoAnswered'])
        ->name('response-management.toggle-auto-answered');

    Route::patch('/settings/imap-configuration', [SettingsController::class, 'updateImapConfiguration'])
        ->name('settings.imap-configuration.update');
    Route::patch('/settings/open-ai-configuration', [SettingsController::class, 'updateOpenAIConfiguration'])
        ->name('settings.open-ai-configuration.update');
    Route::patch('/settings/generate-assistant', [SettingsController::class, 'generateAssistant'])
        ->name('settings.generate-assistant');
    Route::patch('/settings/smtp-configuration', [SettingsController::class, 'updateSmtpConfiguration'])
        ->name('settings.smtp-configuration.update');


    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/files', [FileController::class, 'store'])->name('files.store');

});


require __DIR__ . '/auth.php';
