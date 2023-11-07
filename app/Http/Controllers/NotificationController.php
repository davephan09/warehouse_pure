<?php

namespace App\Http\Controllers;

use App\Enums\NotificationType;
use App\Models\User;
use App\Repositories\NotificationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    private $notification;
    public function __construct(NotificationRepository $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            try {
                $test = User::permission('notification.order')->get();dd($test);
                $data['title'] = trans('notify.list_noti');
                $data['notify_type'] = NotificationType::asSelectArray();
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return response()->view('errors.404', [], 404);
            }
            return view('notification.index', $data);
        }
        return response()->view('errors.404', [], 404);
    }

    public function getData(Request $request)
    {
        $user = Auth::user();
        if ($user->can('notification.read')) {
            try {
                $perPage = cleanNumber($request->get('perPage'));
                $textSearch = cleanInput($request->get('text'));
                $type = cleanNumber($request->input('type'));

                $notifications = $this->notification->filters([
                    'perPage' => $perPage ?? 15,
                    'method' => NotificationType::getKey($type),
                ]);

                $data['notifications'] = $notifications;
                $data['htmlNotificationTable'] = view('notification.notify_table', $data)->render();
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error($e);
                return $this->iRespond(false, 'error');
            }
            return $this->iRespond(true, 'success', $data);
        }
        return response()->view('errors.404', [], 404);
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
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->can('notification.create')) {
            DB::connection()->beginTransaction();
            $rules = [
                'title' => 'required|string|max:255|min:1',
                // 'users' => 'max:40|string|nullable',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->iRespond(false, trans('common.error_try_again'), null, $validator->errors());
            }
            try {
                $requestInput = cleanInput($request->toArray());
                $notify = $this->notification->create($requestInput);
                if ($notify) \Illuminate\Support\Facades\Log::info($user->username . ' has created a notification: ' . $notify->toJson());
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
