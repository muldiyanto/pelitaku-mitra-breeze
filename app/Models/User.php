<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Panel;
use App\Models\Team;
use App\Models\Satker;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\HasTenants;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements HasTenants //FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'password',
        'satker_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
         'email_verified_at' => 'datetime',
         'password' => 'hashed',
    ];

    // Coding utama Tenant
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }

    public function getTenants(Panel $panel): Collection
    {
        return $this->teams;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->teams->contains($tenant);
    }
    //

    public function role(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function team(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }

    public function satker(): BelongsTo
    {
        return $this->belongsTo(Satker::class);
    }

}

// php artisan migrate:rollback --path=/database/migrations/2023_09_21_103248_create_kategoris_table.php
