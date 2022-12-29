<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Models\User;

/**
 * @mixin IdeHelperAddress
 */
class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address'
    ];

    /**
     * Get the parent addressable model (post or video).
     */
    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Store addresses in database
     * @param array $addressData
     * @param Model $addressable
     * @return bool|iterable
     */
    public static function storeAddresses(array $addressData, $addressable, $update = false): iterable|bool
    {
        //delete user addresses if update is true
        $update ? $addressable->addresses()->delete() : false;

        //store user addresses
        $addresses = [];
        foreach ($addressData as $data) {
            $addresses[] = new Address(['address' => $data['addresses']]);
        }
        return count($addresses) > 0 ? $addressable->addresses()->saveMany($addresses) : true;
    }
}
