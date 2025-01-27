<?php

namespace App\Http\Controllers;

use App\Models\FlashcardSet;
use Illuminate\Http\Request;
use App\Models\Flashcard;
use Inertia\Inertia;

class FlashcardController extends Controller
{
    // Display a listing of the flashcards


    // Show the form for creating a new flashcard
    public function create()
    {
        return Inertia::render('Flashcards/Create');
    }

    // Store a newly created flashcard in storage
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);

        Flashcard::create($request->all());


    }

    // Display the specified flashcard
    /*   public function show(Flashcard $flashcard)
      {
          return Inertia::render('Flashcards/Show', ['flashcard' => $flashcard]);
      } */

    // Show the form for editing the specified flashcard
    public function edit(Flashcard $flashcard)
    {
        return Inertia::render('Flashcards/Edit', ['flashcard' => $flashcard]);
    }

    // Update the specified flashcard in storage
    public function update(Request $request, Flashcard $flashcard)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);

        $flashcard->update($request->all());

        $deck = FlashcardSet::find($flashcard->flashcard_set_id);

        return Inertia::render('Decks/Show', [
            'flashcardSet' => $deck->load('flashcards'),
        ]);


    }

    // Remove the specified flashcard from storage
    public function destroy(Flashcard $flashcard)
    {
        $flashcard->delete();

        return redirect()->route('flashcards.index')
            ->with('success', 'Flashcard deleted successfully.');
    }
}