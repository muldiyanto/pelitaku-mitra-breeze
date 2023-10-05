<?php

namespace App\Models;

use App\Models\Pelatihan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PemilikProgram extends Model
{
    use HasFactory;

    protected $fillable = [
     'name',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
    public function pelatihan(): HasMany
    {
        return $this->hasMany(Pelatihan::class);
    }
}
