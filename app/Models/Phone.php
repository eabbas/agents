<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Notifications\Notifiable;

/**
 * @mixin IdeHelperPhone
 */
class Phone extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'type',
        'number',
    ];

    /**
     * Get the parent phoneable model (post or video).
     */
    public function phoneable(): MorphTo
    {
        return $this->morphTo();
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Store Phones in database
     * @param array $addressData
     * @param Model $phoneable
     * @return bool|iterable
     */

    public static function storePhones(array $phonesData, $phoneable, $update = false): iterable|bool
    {
        $update ? $phoneable->phones()->delete() : false;
        $phones = [];
        foreach ($phonesData as $data) {
            $phones[] = new Phone(['type' => $data['type'], 'number' => $data['number']]);
        }
        return count($phones) > 0 ? $phoneable->phones()->saveMany($phones) : true;
    }
}
