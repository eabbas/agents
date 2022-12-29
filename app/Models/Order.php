<?php

namespace App\Models;

use App\Traits\BelongsToAgent;
use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @mixin IdeHelperOrder
 */
class Order extends Model
{
    use HasFactory;
    use BelongsToAgent;

    protected $guarded = [];

    protected $fillable = [
        'agent_id',
        'kits',
        'product_id',
        'client_id',
        'price'
    ];

    protected $casts = [
        'kits' => 'array'
    ];

    public function product(): Model|Builder|Product|null
    {
        return Product::whereId($this->product_id)?->first();
    }

    public function kits(): array
    {
        $kits = [];

        foreach ($this->kits as $kit)
            $kits[] = Kit::whereId($kit)->first();

        return $kits;
    }
}
