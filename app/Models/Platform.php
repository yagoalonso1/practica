<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'owner'];

    public function apartments(): BelongsToMany
    {
        return $this->belongsToMany(Apartment::class, 'platform_apartment')
                    ->withPivot('register_date', 'premium')
                    ->withTimestamps();
    }
}