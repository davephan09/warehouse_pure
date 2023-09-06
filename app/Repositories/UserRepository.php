<?php 
namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    public function getModel(): string
    {
        return User::class;
    }

    public function getUserList()
    {
        $users = $this->model->get(['id', 'username', 'first_name', 'last_name', 'email', 'created_at', 'last_login_at', 'last_login_ip', 'last_logout_at']);
        return $users;
    }

    public function filters($filters = [])
    {
        $userRoleTable = 'model_has_roles';
        $query = $this->model->query();
        $query->select('id', 'username', 'first_name', 'last_name', 'email', 'avatar', 'created_at', 'last_login_at', 'last_login_ip', 'last_logout_at');

        if(!empty($filters['select'])) {
            $query->select($filters['select']);
        }
        if(!empty($filters['addSelect'])) {
            $query->addSelect($filters['addSelect']);
        }
        if(!empty($filters['relations'])) {
            $query->with($filters['relations']);
        }
        if(!empty($filters['roleIds'])) {
            $query->join($userRoleTable . ' as R', 'R.model_id', '=', $this->model->getTable() . '.id')
                ->whereIn('R.role_id', $filters['roleIds']);
        }
        if(!empty($filters['keyword'])) {
            $text = $filters['keyword'];
            $query = $query->where(function($subQuery) use ($text) {
                $subQuery->whereRaw('LOWER(username) LIKE ?', ['%' . strtolower($text) . '%'])
                    ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($text) . '%'])
                    ->orWhereRaw('LOWER(first_name) LIKE ?', ['%' . strtolower($text) . '%'])
                    ->orWhereRaw('LOWER(last_name) LIKE ?', ['%' . strtolower($text) . '%']);
            });
        }
        
        if(!empty($filters['id'])) {
            $data = $query->where('id', $filters['id'])->first();
        } else if(!empty($filters['username'])) {
            $data = $query->where('username', $filters['username'])->first();
        } else {
            $data = $query->orderByDesc('id')->paginate($filters['perPage']);
        }
        return $data;
    }

    public function updateInfor($request)
    {
        $id = cleanNumber($request->input('id'));
        $user = $this->find($id);
        if (isset($user)) {
            $fullname = cleanInput($request->input('fullname'));
            $nameParts = explode(' ', $fullname);
            $lastname = array_pop($nameParts);
            $firstname = implode(" ", $nameParts);
            $update = $user->update([
                'first_name' => $firstname,
                'last_name' => $lastname,
                'phone' => cleanInput($request->input('phone')),
                'email' => cleanInput($request->input('email')),
                'avatar' => cleanInput($request->input('type')) === 'change' ? $request->input('avatar_url') : $user->avatar,
            ]);
            return $update;
        }
        return false;
    }
}