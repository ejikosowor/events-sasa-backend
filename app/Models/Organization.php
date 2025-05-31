<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Traits\HasSlug;

class Organization extends Model
{
    use HasSlug, HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * The events that belong to the organization.
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    /**
     * The users that belong to the organization.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
