<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlashcardSet extends Model
{
    protected $fillable = ['user_id', 'name'];

    public function flashcards()
    {
        return $this->hasMany(Flashcard::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
