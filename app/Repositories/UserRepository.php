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
}