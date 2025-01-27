<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use App\Models\FlashcardSet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DeckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $user->load('flashcardSets');
        return Inertia::render('Decks/Index', [
            'flashcardSets' => $user->flashcardSets,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('Decks/Create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'name' => 'required|string',
            'flashcards' => 'required|array',
            'flashcards.*.question' => 'required|string',
            'flashcards.*.answer' => 'required|string',
        ]);

        $flashcardSet = FlashcardSet::create([
            'user_id' => $user->id,
            'name' => $data['name'],
        ]);
        foreach ($data['flashcards'] as $item) {
            $flashcardSet->flashcards()->create([
                'question' => $item['question'],
                'answer' => $item['answer'],
            ]);
        }

        return response()->json(['message' => 'Flashcards created successfully'], 201);
    }

    public function show($id)
    {
        $flashcardSet = FlashcardSet::findOrFail($id);
        return Inertia::render('Decks/Show', [
            'flashcardSet' => $flashcardSet->load('flashcards'),
        ]);
    }

    public function edit($id)
    {
        $flashcardSet = FlashcardSet::findOrFail($id);
        return Inertia::render('Decks/Edit', [
            'flashcardSet' => $flashcardSet->load('flashcards'),
        ]);


    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'string',
            'flashcards' => 'array',
            'flashcards.*.question' => 'string',
            'flashcards.*.answer' => 'string',
        ]);

        $flashcardSet = FlashcardSet::findOrFail($id);

        // Update the flashcard set name
        $flashcardSet->update(['name' => $data['name']]);

        // Get the IDs of flashcards that were sent in the update
        $updatedFlashcardIds = collect($data['flashcards'])->pluck('id')->filter();

        // Delete flashcards that are no longer present
        $flashcardSet->flashcards()->whereNotIn('id', $updatedFlashcardIds)->delete();

        // Process flashcards
        foreach ($data['flashcards'] as $item) {
            if (isset($item['id'])) {
                // Update existing flashcard
                $flashcard = $flashcardSet->flashcards()->find($item['id']);
                if ($flashcard) {
                    $flashcard->update([
                        'question' => $item['question'],
                        'answer' => $item['answer'],
                    ]);
                }
            } else {
                // Create new flashcard
                $flashcardSet->flashcards()->create([
                    'question' => $item['question'],
                    'answer' => $item['answer'],
                ]);
            }
        }

        return Inertia::render('Decks/Show', [
            'flashcardSet' => $flashcardSet->load('flashcards'),
        ]);
    }



    public function revise($id)
    {
        $flashcardSet = FlashcardSet::findOrFail($id)->load('flashcards');
        return Inertia::render('Decks/Revise', [
            'flashcards' => $flashcardSet,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flashcard $flashcard)
    {
        //
    }
}
