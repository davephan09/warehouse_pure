<?php

namespace App\Observers;

use App\Models\Notifications;
use App\Models\NotificationUsers;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderProduct;
use Illuminate\Support\Facades\DB;

class OrderObserver
{
    public function created(Order $order)
    {
        // $users = User
    }

    public function updated(Order $order)
    {
        DB::connection()->beginTransaction();
        try {
            $user = auth()->user();
            $noti = Notifications::create([
                'module_name' => 'order',
                'title' => $user->first_name . ' ' . $user->last_name . ' đã cập nhật một đơn xuất hàng tới ' . $order->customer->name,
                'module_id' => $order->id,
                'user_id' => auth()->user()->id,
            ]);

            $followers = User::permission('notification.order')->get();
            $followerIds = $followers->pluck('id')->toArray();

            foreach ($followerIds as $user) {
                $data[] = [
                    'user_id' => $user,
                    'noti_id' => $noti->id,
                ];
            }
            NotificationUsers::insert($data);

            foreach ($followers as $follower) {
                $follower->notify(new OrderProduct($noti->title, $noti->created_at));
            }
            DB::connection()->commit();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e);
            DB::connection()->rollBack();
        }
    }
}
