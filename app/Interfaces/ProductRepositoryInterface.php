<?php

namespace App\Interfaces;

use App\Http\Requests\StoreProductRequest;

interface ProductRepositoryInterface

{
    public function store(StoreProductRequest $request);
}
