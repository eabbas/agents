<?php

namespace App\Models;

use App\Traits\BelongsToAgent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kit;

/**
 * @mixin IdeHelperProduct
 */
class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kits()
    {
        return $this->belongsToMany(Kit::class);
    }
}
