<?php

namespace App\Models;

use App\Observers\ObservesWrites;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory,
        ObservesWrites;

    protected $guarded = ['id'];

    /**
     *
     * @return BelongsToMany
     *
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
