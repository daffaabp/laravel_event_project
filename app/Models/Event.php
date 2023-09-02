<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\City;
use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Attending;
use App\Models\SavedEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'start_datetime',
        'end_date',
        'image',
        'address',
        'user_id',
        'country_id',
        'city_id',
        'num_tickets',
    ];

    protected $casts = [
        'start_datetime' => 'datetime:d-m-Y, H:i:s',
        'end_date' => 'date:d/m/Y',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    // relasi banyak komentar
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // banyak komentar suka
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function savedEvents(): HasMany
    {
        return $this->hasMany(SavedEvent::class);
    }

    // event ini akan banyak dihadiri oleh tamu undangan
    public function attendings(): HasMany
    {
        return $this->hasMany(Attending::class);
    }

    // event ini akan memiliki banyak sekali tag
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tag)
    {
        return $this->tags->contains($tag); // kembalikan benar atau salah jika hubungan pajak ini mengandung tag yang kita lewati
    }
}