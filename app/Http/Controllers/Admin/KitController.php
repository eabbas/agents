<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\KitsDataTable;
use App\Http\Requests\StoreProductKitRequest;
use App\Http\Requests\UpdateProductKitRequest;
use App\Repositories\ProductKitRepository;
use App\Models\Kit;

class KitController extends Controller
{

    private $repository;

    public function __construct(ProductKitRepository $repository)
    {
        $this->setTitle('کیت ها');
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @param KitsDataTable $dataTable
     * @return \Illuminate\Http\Response
     */
    public function index(KitsDataTable $dataTable)
    {
        return $dataTable->render('panel.kits.index');
    }

    public function create()
    {
        return view('panel.kits.create');
    }
    public function store(StoreProductKitRequest $request)
    {
        $kit = $this->repository->storekit($request);

        return redirect()->route('product.kits.index');
    }
    public function edit(Kit $kit)
    {
        return view('panel.kits.edit', ['data' => $kit]);
    }
    public function update(UpdateProductKitRequest $request, Kit $kit)
    {

        $kit = $this->repository->update($request, $kit);
        return redirect()->route('product.kits.index');
    }
    public function destroy($id)
    {
        $this->repository->delete($id);
        return response('', 200);
    }
}
