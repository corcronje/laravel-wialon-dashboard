<?php

namespace App\Traits;

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToRole
{
    public function role() : BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole(int $id): bool
    {
        return $this->role_id === $id;
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(Role::ADMIN);
    }

    /**
     * Check if the user is a user.
     */
    public function isUser(): bool
    {
        return $this->hasRole(Role::USER);
    }

    public function scopeAdmins($query)
    {
        return $query->where('role_id', Role::ADMIN);
    }

    public function scopeUsers($query)
    {
        return $query->where('role_id', Role::USER);
    }
}
