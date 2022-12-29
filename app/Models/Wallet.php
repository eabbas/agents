<?php

namespace App\Models;

use App\Models\Scopes\AgentScope;
use App\Traits\BelongsToAgent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperWallet
 */
class Wallet extends Model
{
    use HasFactory, BelongsToAgent;
    protected $guarded = [];


    public static function chargeWallet($walletId, $amount)
    {
        $wallet = self::whereId($walletId)->first();

        if ($wallet != null && $wallet->exists()) {

            $currentBalance = $wallet->balance;
            $update = $wallet->update([
                'balance' => $currentBalance + $amount
            ]);

            // TODO: do something if increasing balance failed
        }
    }
}
