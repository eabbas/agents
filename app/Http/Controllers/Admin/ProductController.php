<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\DataTables\ProductsDataTable;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->setTitle('محصولات');
        $this->repository = $repository;
    }
    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('panel.products.index');
    }
    public function create()
    {
        $kits = $this->repository->getKits();
        return view('panel.products.create', ['kits' => $kits]);
    }
    public function store(StoreProductRequest $request)
    {
        $product = $this->repository->store($request);
        return redirect()->route('product.index');
    }
    public function edit(Product $product)
    {
        $kits = $this->repository->getKits();
        $productKitKeys = array_keys($product['kits']->pluck('title', 'id')->toArray());
        return view('panel.products.edit', ['product' => $product, 'kits' => $kits, 'keys' => $productKitKeys]);
    }
    public function update(StoreProductRequest $request, Product $product)
    {
        $kit = $this->repository->updateProduct($request, $product);
        return redirect()->route('product.index');
    }

    public function destroy(Product $product)
    {
        $this->repository->deleteProduct($product);
        return response('', 200);
    }
}
