<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'description',
        'permissions',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'permissions' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    /** Only keys that still exist in config/admin_permissions.php count. */
    public function grants(string $permission): bool
    {
        return $this->is_active
            && array_key_exists($permission, config('admin_permissions'))
            && in_array($permission, $this->permissions ?? [], true);
    }
}
