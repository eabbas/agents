<?php

namespace App\Interfaces;


use App\DataTables\ClientOrdersDataTable;
use App\DataTables\ClientsDataTable;
use App\Http\Requests\Client\StoreCompanyRequest;
use App\Http\Requests\Client\StorePersonalRequest;
use App\Http\Requests\Client\UpdateCompanyRequest;
use App\Http\Requests\Client\UpdatePersonalRequest;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

interface ClientRepositoryInterface
{
    public function index(ClientsDataTable $dataTable);

    public function details(Client $client, ClientOrdersDataTable $dataTable);

    public function orderIndex(Client $client): Factory|View|Application;

    public function create(): Factory|View|Application;

    public function destroy(Client $client);

    public function edit(Client $client);

    public function createPersonalClient(StorePersonalRequest $request): Client|Builder|bool;

    public function createCompanyClient(StoreCompanyRequest $request): mixed;

    public function sendPaymentURL(Request $request): mixed;

    public function pay(Client $client, Request $request): mixed;

    public function getKits(Client $client, Product $product): array;

    public function updateCompany(UpdateCompanyRequest $requets, Client $client);

    public function updatePersonal(UpdatePersonalRequest $request, Client $client);
}
