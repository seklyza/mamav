<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'datetime'
    ];

    protected $hidden = [
        'join_secret'
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id', 'id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'event_participant', 'event_id', 'participant_id')->withTimestamps();
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'event_id', 'id');
    }
}
