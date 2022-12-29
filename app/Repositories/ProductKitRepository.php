<?php

namespace App\Repositories;

use App\Interfaces\ProductKitRepositoryInterface;
use App\Http\Requests\StoreProductKitRequest;
use App\Http\Requests\UpdateProductKitRequest;
use App\Models\Kit;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

class ProductKitRepository implements ProductKitRepositoryInterface
{

    public function storekit(StoreProductKitRequest $request)
    {
        $data = $request->validated();

        return Kit::create($data);
    }

    public function update(UpdateProductKitRequest $request, Kit $kit)
    {
        $data = $request->validated();
        return $kit->update($data);
    }
    public function delete($id)
    {
        return Kit::destroy($id);
    }
}
