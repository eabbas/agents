<?php

namespace App\Http\Controllers\Agent;

use App\DataTables\AgentOrdersDataTable;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Collection;

class UserController extends Controller
{

    private $repository;

    public function __construct(UserRepository $repository)
    {

        $instance = $this;
        $this->middleware(function ($request, $next) use ($instance) {
            $instance->setTitle(
                auth()->user()->role === 'admin' ?
                    'نمایندگان' : 'زیرنماینده ها'
            );
            return $next($request);
        });

        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param UsersDataTable $dataTable
     * @return Response
     */

    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->response(function (Collection $collection) {
            $collection['data'] = collect($collection['data'])->map(function ($data) {
                if ($data['agent_id'] == auth()->user()->id || auth()->user()->role == 'admin') {
                    return $data;
                }
            });
            return $collection;
        })->render('panel.users.index');
    }

    public function details(User $user, AgentOrdersDataTable $dataTable)
    {
        $data['user'] = $user;
        return $dataTable->render('panel.users.details', $data);
    }


    public function login_as(User $user)
    {
        if ($user->agent_id == auth()->user()->id || auth()->user()->role == 'admin') {
            session()->put('up_level_user', auth()->user()->id);
            auth()->loginUsingId($user->id);
            return redirect('/panel/agent');
        }
        return redirect('/forbidden');
    }


    public function login_up()
    {
        $main_user_id = session()->get('up_level_user');
        if (!$main_user_id) return redirect('/panel/agent');

        if (User::whereId($main_user_id)->first()->role !== 'admin' && auth()->user()->agent_id !== $main_user_id) {
            return redirect('/panel/agent');
        }

        session()->remove('up_level_user');
        auth()->loginUsingId($main_user_id);
        return redirect('/panel/agent');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('panel.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */

    // store new user
    public function store(StoreUserRequest $request)
    {
        $user = $this->repository->CreateUser($request);

        return redirect()->route('agent.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(User $user)
    {
        return view('panel.users.edit', ['requestedData' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {

        $user = $this->repository->updateUser($request, $user);
        return redirect()->route('agent.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(User $user)
    {
        $this->repository->deleteUser($user);
        return response('', 200);
    }
}
