<?php

use App\Models\Note;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::match(['PUT', 'POST'], '/save', function (Request $request) {
    $note_values = [
        'content' => $request->input('content') ?? $request->get('content', null),
        'id' => $request->input('id') ?? $request->input('id', null),
        'title' => $request->input('title') ?? $request->input('title', null),
    ];
    $note = new Note();
    if ($note_values['id']) {
        $note = Note::find($note_values['id']);
    }
    $note->title = $note_values['title'];
    $note->content = $note_values['content'];
    $note->save();

    return response()->json([
        'id' => $note->id,
        'title' => $note->title,
        'content' => $note->content,
    ]);
});

Route::get('/tags', function (Request $request) {
    $query = $request->get('query', '');

    if (empty($query)) {
        return response()->json([
            'tags' => collect([])
        ]);
    }

    $tags = Tag::where('label', 'LIKE', '%' . $query . '%')
        ->orderBy('label', 'asc')
        ->get();

    return response()->json([
        'tags' => $tags
    ]);
});