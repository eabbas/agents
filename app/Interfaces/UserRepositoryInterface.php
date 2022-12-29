<?php

namespace App\Interfaces;

use App\Http\Requests\StoreUserRequest;

interface UserRepositoryInterface

{
    public function createUser(StoreUserRequest $request);
}
