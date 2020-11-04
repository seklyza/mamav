<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;

Route::prefix('/events')->name('events')->group(function () {
    Route::get('', [EventController::class, 'upcomingEvents'])->name('');
    Route::get('/create', [EventController::class, 'create'])->name('.create');
    Route::post('/create', [EventController::class, 'store'])->name('.store');

    Route::delete('/{event}', [EventController::class, 'delete'])->name('.delete');
    Route::get('/{event}', [EventController::class, 'show'])->name('.show');

    Route::prefix('/{event}')->middleware('can:update,event')->group(function () {
        Route::post('/link', [EventController::class, 'generateLink'])
            ->name('.generate-link');
        Route::delete('/participants/{participant}', [ParticipantController::class, 'delete'])
            ->name('.participants.delete');
        Route::post('/participants/{participant}/make-organizer', [ParticipantController::class, 'makeOrganizer'])
            ->name('.participants.make-organizer');

        Route::get('/items', [ItemController::class, 'index'])
            ->name('.items');
    });

    Route::post('/{event}/items', [ItemController::class, 'addItem'])->name('.items.store');
    Route::delete('/{event}/items/{item}', [ItemController::class, 'deleteItem'])->name('.items.delete');
});

Route::get('/my-events', [EventController::class, 'myEvents'])->name('my-events');
Route::get('/previous-events', [EventController::class, 'previousEvents'])->name('previous-events');
