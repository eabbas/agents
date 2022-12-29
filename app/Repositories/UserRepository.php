<?php

namespace App\Repositories;

use App\Http\Interfaces\ClientRepositoryInterface;
use App\Http\Requests\Client\StoreCompanyRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Address;
use App\Models\User;
use App\Models\Phone;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use App\Interfaces\UserRepositoryInterface;
use DB;
use Exception;

class UserRepository implements UserRepositoryInterface
{


    public function getUser($id)
    {
        $user = User::with('phones')->with('addresses')->find($id)->toArray();
        return $user;
    }


    // prepare request to store user
    public function createUser(StoreUserRequest $request)
    {
        $data = $request->validated();

        // assign fullname for personal form
        $data['full_name'] = $data['name'] . ' ' . $data['family'];

        // assign role to new user
        $data['role'] = "agent";

        //Get current user id and assign it to user role
        $data['agent_id'] = $this->getCurrentUserId();

        // return $this->storeUser($data);
        return $this->storeUser($data);
    }
    public function getCurrentUserId()
    {
        return auth()->user()->id;
    }

    public function updateUser(UpdateUserRequest $request, User $user)
    {

        $data = $request->validated();

        // assign fullname for user
        $data['full_name'] = $data['name'] . ' ' . $data['family'];

        //remove phones from data array
        $phones = array_key_exists('phones', $data) ? $data['phones'] : [];
        if (array_key_exists('phones', $data)) {
            $this->removeFromArrayIfExist($data, ['phones']);
        }

        // remove addresses from data array
        $addresses = array_key_exists('addresses', $data) ? $data['addresses'] : [];
        if (array_key_exists('addresses', $data)) {
            $this->removeFromArrayIfExist($data, ['addresses']);
        }

        // remove password from data array
        if (is_null($data['password'])) {
            $this->removeFromArrayIfExist($data, ['password']);
        }

        //update user , phones and addresses then return response
        try {
            $user_phone_address_updated = DB::Transaction(function () use ($data, $phones, $addresses, $user) {
                return $user->update($data) &&
                    Phone::storePhones($phones, $user, true) &&
                    Address::storeAddresses($addresses, $user, true) ? $user : false;
            });
            return $user_phone_address_updated;
        } catch (Exception $e) {
            return redirect()->back()->withErrors('message', 'آپدیت اطلاعات با مشکل مواجه شد');
        }
    }


    //store users
    private function storeUser(array $data)
    {

        //remove phones from data arary
        $phones = array_key_exists('phones', $data) ? $data['phones'] : [];
        if (array_key_exists('phones', $data)) {
            $this->removeFromArrayIfExist($data, ['phones']);
        }

        // remove addresses from data array
        $addresses = array_key_exists('addresses', $data) ? $data['addresses'] : [];
        if (array_key_exists('addresses', $data)) {
            $this->removeFromArrayIfExist($data, ['addresses']);
        }

        try {
            // transaction to user and user's phones and addresses
            $user_phone_address_created = DB::transaction(function () use ($data, $phones, $addresses) {
                // create user
                $user = user::create($data);

                // store phones and addresses in database and return response
                return $user->wasRecentlyCreated &&
                    Phone::storePhones($phones, $user) &&
                    Address::storeAddresses($addresses, $user) ? $user : false;
            });
            return $user_phone_address_created;
        } catch (Exception $e) {
            return redirect()->route('agent.users.create')->withErrors('message', 'ذخیره اطلاعات با مشکل مواجه شد');
        }
    }

    public function deleteUser(User $user)
    {
        return User::destroy($user['id']) && $user->phones()->delete() && $user->addresses()->delete();
    }

    private function removeFromArrayIfExist(array &$array, $keys): void
    {
        foreach ($keys as $key) {
            if (isset($array[$key])) unset($array[$key]);
        }
    }
}
