<?php

namespace App\Traits;

use App\Models\Role;

trait BelongsToRole
{
    public function role() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole(string $role): bool
    {
        return strtolower($this->role->name) === strtolower($role);
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
}
