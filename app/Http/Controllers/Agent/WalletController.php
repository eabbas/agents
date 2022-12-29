<?php

namespace App\Http\Controllers\Agent;

use App\DataTables\TransactionsDatatable;
use App\Http\Controllers\Controller;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class WalletController extends Controller
{

    public function __construct()
    {
        $this->setTitle('موجودی پنل');
    }

    /**
     * display a listing of the resource.
     *
     * @return Response
     */
    public function index(TransactionsDatatable $dataTable)
    {
        $data['wallet'] = auth()->user()->wallet();

        return $dataTable->response(function (Collection $response) {
            $response['data'] = collect($response['data'])->map(function ($data) {
                $data['created_at'] = piry_gregorian_to_jalali(Carbon::parse($data['created_at']));
                $data['updated_at'] = piry_gregorian_to_jalali(Carbon::parse($data['updated_at']));
                $data['status'] = trans('_.status.' . $data['status']);
                return $data;
            })->toArray();
            return $response;
        })->render('panel.wallet.index', $data);
    }
}
