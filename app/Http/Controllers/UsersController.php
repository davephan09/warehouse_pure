<?php

namespace App\Http\Controllers;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    private $user;
    private $role;
    public function __construct(UserRepository $user, RoleRepository $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->can('user.read')) {
            $roles = $this->role->getAll();
            $roles = $roles->keyBy('id');
            $data['roles'] = $roles;
            $data['title'] = trans('role_permission.user_list');
            return view('users.index', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getData(Request $request)
    {
        $roleId = cleanNumber($request->input('roleId'));
        $keyword = cleanInput($request->input('text'));
        $data = array();
        $users = $this->user->filters([
            'roleIds' => !empty($roleId) ? [$roleId] : [],
            'keyword' => $keyword,
            'perPage' => 10
        ]);
        $data['users'] = $users;
        $data['htmlUserTable'] = view('users.user_table', $data)->render();
        return $this->iRespond(true, '', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        if ($user->can('user.delete')) {
            DB::connection()->beginTransaction();
            try {
                $id = cleanNumber($request->input('id'));
                $userDelete = $this->user->filters([
                    'id' => $id,
                ]);
                $userDelete->roles()->detach();
                $userDelete->permissions()->detach();
                $delete = $userDelete->delete();
                if ($delete) \Illuminate\Support\Facades\Log::info($user->username . ' has deleted a user: ' . $userDelete->toJson());
                DB::connection()->commit();
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                DB::connection()->rollBack();
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success');
        }
        return response()->view('errors.404', [], 404);
    }
}
