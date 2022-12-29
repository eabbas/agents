<?php

namespace App\Interfaces;

use App\Http\Requests\StoreProductKitRequest;

interface ProductKitRepositoryInterface

{
    public function storekit(StoreProductKitRequest $request);
}
