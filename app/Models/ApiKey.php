<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ApiKey extends Model
{
    protected $fillable = ['name', 'key_hash', 'key_prefix', 'last_used_at', 'status'];

    protected $casts = [
        'last_used_at' => 'datetime',
        'status'       => 'boolean',
    ];

    /**
     * Create a new key and return [model, plainKey].
     * The plain key is only available here — it is shown to the admin once and never stored.
     */
    public static function generate(string $name): array
    {
        $plain = 'gnimt_' . Str::random(40);

        $key = static::create([
            'name'       => $name,
            'key_hash'   => hash('sha256', $plain),
            'key_prefix' => substr($plain, 0, 12),
            'status'     => 1,
        ]);

        return [$key, $plain];
    }

    public static function findActiveByPlain(?string $plain): ?self
    {
        if (! $plain) {
            return null;
        }

        return static::where('key_hash', hash('sha256', $plain))->where('status', 1)->first();
    }
}
