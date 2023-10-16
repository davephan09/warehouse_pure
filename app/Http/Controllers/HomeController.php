<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function changeLocale(Request $request)
    {
        $locale = cleanInput($request->input('lang'));
        if ($request->user()) {
            $user = User::find($request->user()->id);
            $user->language = $locale;
            $user->save();
        } else {
            Session::put('locale', $locale);
        }
        return $this->iRespond(true, 'success');
    }
}
