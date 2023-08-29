<?php

namespace App\Models;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SavedEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id'
    ];

    // relasi yang bersifat tunggal (berdiri sendiri) = pengguna ke pengguna
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // relasi yang bersifat tunggal (berdiri sendiri) = acara ke acara
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
