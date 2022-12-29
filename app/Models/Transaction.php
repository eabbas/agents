<?php

namespace App\Models;

use App\Traits\BelongsToAgent;
use Database\Factories\TransactionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


/**
 * @mixin IdeHelperTransaction
 */
class Transaction extends Model
{
    use HasFactory;
    use BelongsToAgent;

    protected $guarded = [];

    protected $fillable = [
        'agent_id',
        'payment_method',
        'wallet_id',
        'client_id',
        'verified',
        'res_code',
        'merchant_id',
        'user_ip',
        'ref_id',
        'order_id',
        'sale_order_id',
        'sale_reference_id',
        'status',
        'amount',
        'agent_share',
        'payment_time',
        'card_info',
        'card_pan',
        'description',
    ];

    public function order(): Model|Builder|Order|null
    {
        return Order::whereId($this->order_id)?->first();
    }
}
