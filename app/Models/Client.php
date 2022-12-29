<?php

namespace App\Models;

use App\Traits\BelongsToAgent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @mixin IdeHelperClient
 * @method static Builder|Client create(array $attributes)
 */
class Client extends Model
{
    use HasFactory;
    use BelongsToAgent;

    protected $guarded = [];

    public function phones(): MorphMany
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }
}
