<?php

namespace App\Models;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Satker extends Model
{
    use HasFactory;

    protected $fillable = [
     'kode',
     'name',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
