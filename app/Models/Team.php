<?php

namespace App\Models;

use App\Models\User;
use App\Models\Satker;
use App\Models\IsiMateri;
use App\Models\Pelatihan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug'];

    public function satkers(): HasMany
    {
        return $this->hasMany(Satker::class);
    }

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class);
    }
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function pemilikprograms(): HasMany
    {
        return $this->hasMany(PemilikProgram::class);
    }
    public function pelatihans(): HasMany
    {
        return $this->hasMany(Pelatihan::class);
    }

    public function kategoris(): HasMany
    {
        return $this->hasMany(Kategori::class);
    }

    public function materis(): HasMany
    {
        return $this->hasMany(Materi::class);
    }

    public function isimateris(): HasMany
    {
        return $this->hasMany(IsiMateri::class);
    }
}
