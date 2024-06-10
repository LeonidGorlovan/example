<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * @property int id
 * @property int user_id
 * @property string title
 * @property string text
 * @property Carbon created_at
 * @property Carbon updated_at
 */

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'text'
    ];

    protected static function booted(): void
    {
        static::creating(function (Entry $entry) {
            $entry->user_id = Auth::id();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAuthor(Builder $query): void
    {
        $query->where('user_id', Auth::id());
    }
}
