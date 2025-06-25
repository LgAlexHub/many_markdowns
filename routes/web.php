<?php

use App\Models\Note;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->name('notes')->group(function () {
    Route::get('notes', fn() => Inertia::render('Notes', [
        'notes' => Note::all()
    ]))->name('app');

    Route::get('app/{note?}', function (Note $note) {
        return Inertia::render('AppEditor', [
            'note' => $note->id ? $note : null,
        ]);
    })->name('notes.new');

    Route::delete('/notes/{note}', function (Note $note) {
        $note->delete();
        return response()->redirectToRoute('notes');
    });
});




require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
