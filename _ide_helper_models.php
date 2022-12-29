<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Address
 *
 * @mixin IdeHelperAddress
 * @property int $id
 * @property string $address
 * @property string $addressable_type
 * @property int $addressable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $addressable
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddressableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddressableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 */
	class Address extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Client
 *
 * @mixin IdeHelperClient
 * @method static Builder|Client create(array $attributes)
 * @property int $id
 * @property string $type
 * @property string $name
 * @property string|null $family
 * @property string|null $submit_number
 * @property string|null $full_name
 * @property string|null $birth
 * @property string|null $father_name
 * @property string|null $province
 * @property string|null $city
 * @property string|null $job
 * @property string $agent_username
 * @property int|null $agent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Address[] $addresses
 * @property-read int|null $addresses_count
 * @property-read \App\Models\User|null $agent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Phone[] $phones
 * @property-read int|null $phones_count
 * @method static \Database\Factories\ClientFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAgentUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereFamily($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereFatherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereJob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereSubmitNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Kit
 *
 * @mixin IdeHelperKit
 * @property int $id
 * @property string|null $company_id
 * @property string $title
 * @property string|null $description
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\KitFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Kit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kit whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kit whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kit wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kit whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kit whereUpdatedAt($value)
 */
	class Kit extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @mixin IdeHelperOrder
 * @property int $id
 * @property int $product_id
 * @property array|null $kits
 * @property int|null $agent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $agent
 * @method static \Database\Factories\OrderFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereKits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Phone
 *
 * @mixin IdeHelperPhone
 * @property int $id
 * @property string $number
 * @property string $type
 * @property int $phoneable_id
 * @property string $phoneable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client|null $client
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $phoneable
 * @method static \Illuminate\Database\Eloquent\Builder|Phone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phone query()
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone wherePhoneableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone wherePhoneableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereUpdatedAt($value)
 */
	class Phone extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @mixin IdeHelperProduct
 * @property int $id
 * @property string|null $company_id
 * @property string $title
 * @property int $price
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Kit[] $kits
 * @property-read int|null $kits_count
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @mixin IdeHelperTransaction
 * @property int $id
 * @property int|null $agent_id
 * @property int|null $wallet_id
 * @property int|null $client_id
 * @property string|null $merchant_id
 * @property string|null $type
 * @property string|null $type_value
 * @property string|null $port_name
 * @property string|null $user_ip
 * @property string|null $authority
 * @property string|null $order_id
 * @property string|null $reference
 * @property int|null $payed
 * @property string|null $total
 * @property string|null $agent_share
 * @property int|null $creation_time
 * @property int|null $payment_time
 * @property string|null $card_info
 * @property string|null $card_pan
 * @property string|null $deep_link
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $agent
 * @method static \Database\Factories\TransactionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAgentShare($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAuthority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCardInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCardPan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreationTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDeepLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePayed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePaymentTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTypeValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUserIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereWalletId($value)
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @mixin IdeHelperUser
 * @property int $id
 * @property string $name
 * @property string $family
 * @property string $full_name
 * @property string $username
 * @property string $email
 * @property string $phone
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $role
 * @property int|null $agent_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Address[] $addresses
 * @property-read int|null $addresses_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Phone[] $phones
 * @property-read int|null $phones_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User agent()
 * @method static \Illuminate\Database\Eloquent\Builder|User agentCreate()
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFamily($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Wallet
 *
 * @mixin IdeHelperWallet
 * @property int $id
 * @property int $balance
 * @property string $agent_username
 * @property int|null $agent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $agent
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereAgentUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUpdatedAt($value)
 */
	class Wallet extends \Eloquent {}
}

