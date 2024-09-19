<?php

namespace App\Models;

use App\Observers\ObservesWrites;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory,
        ObservesWrites;

    protected $guarded = ['id'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     *
     * @return HasMany
     *
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     *
     * @return BelongsToMany
     *
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(user::class)->withTimestamps();
    }
}
