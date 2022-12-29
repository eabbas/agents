<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Kit;
use App\Models\Product;
use DB;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

class ProductRepository implements ProductRepositoryInterface
{

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $kits = $data['kits'] ? $data['kits'] : '';
        $this->removeFromArrayIfExist($data, ['kits']);
        try {
            $product_kit_created = DB::transaction(function () use ($data, $kits) {
                $product = Product::create($data);
                return $product->kits()->attach($kits);
            });
            return $product_kit_created;
        } catch (Exception $e) {
            return redirect()->back();
        }
    }

    public function updateProduct(StoreProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $kits = $data['kits'] ? $data['kits'] : '';
        $this->removeFromArrayIfExist($data, ['kits']);

        try {
            $product_kit_updated = DB::transaction(function () use ($data, $product, $kits) {
                return $product->update($data) && $product->kits()->sync($kits);
            });
            return $product_kit_updated;
        } catch (Exception $e) {
            return redirect()->back();
        }
    }

    public function getKits()
    {
        return Kit::select('id', 'title')->get();
    }

    public function deleteProduct(Product $product)
    {
        return Product::destroy($product['id']) && $product->kits()->detach();
    }

    private function removeFromArrayIfExist(array &$array, $keys): void
    {
        foreach ($keys as $key) {
            if (isset($array[$key]) ||  is_null($array[$key])) unset($array[$key]);
        }
    }
}
