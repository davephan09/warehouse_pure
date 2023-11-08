<?php 
namespace App\Repositories;

use App\Models\Notifications;
use App\Models\NotificationUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationRepository extends Repository
{
    public function getModel(): string
    {
        return Notifications::class;
    }

    public function filters($filters = [])
    {
        $user = Auth::user();
        $model = new Notifications();
        $table = $model->getTable();
        $notiUserModel = new NotificationUsers();
        $query = $this->model->select($table.'.*', 'B.read_at')
            ->leftJoin($notiUserModel->getTable() . ' as B', function($join) use ($table, $user) {
                $join->on('B.noti_id', '=', $table.'.id')
                    ->where('B.user_id', $user->id);
            });
           
        if (!$user->hasAnyRole(['Super Admin', 'Manager'])) {
            $query->where($table.'.user_id', $user->id)
                ->where(function ($sQuery) use ($table) {
                    $sQuery->where($table.'.module_name', '!=', 'purchasing')
                        ->where($table.'.module_name', '!=', 'order');
                });
        } else {
            // $query->orWhere($table.'.module_name', 'purchasing')
            //     ->orWhere($table.'.module_name', 'order');
        }

        if (!empty($filters['method']) && $filters['method'] != 'all') {
            $query->where($table.'.module_name', $filters['method']);
        }

        if (!empty($filters['seen'])) {
            $query->where('B.read_at', '!=', null);
        }

        $query->orderBy('created_at','desc');
        if (!empty($filters['limit'])) {
            $result = $query->limit($filters['limit'])->get();
        } else {
            $result = $query->paginate($filters['perPage'] ?? 15);
        }
        return $result;
    }

    public function create($request)
    {
        $user = Auth::user();
        $noti = $this->model->create([
            'module_name' => $request['module_name'] ?? 'other',
            'title' => $request['title'],
            'module_id' => $request['module_id'] ?? null,
            'user_id' => $user->id,
        ]);

        $data = array();
        if ($request['users']) {
            foreach ($request['users'] as $user) {
                $data[] = [
                    'user_id' => $user,
                    'noti_id' => $noti->id,
                ];
            }
        } else {
            foreach (User::all() as $user) {
                $data[] = [
                    'user_id' => $user->id,
                    'noti_id' => $noti->id,
                ];
            }
        }
        NotificationUsers::insert($data);
        return $noti;
    }
}