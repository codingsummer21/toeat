<?php

namespace App\Http\Controllers;

use App\Models\Toit;
use App\Models\User;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    function feed() {
        return view('toeat.feed');
    }

    function addtoit(Request $request) {
        $user = auth()->user();
        $toit = new Toit();
        $toit->content = $request->get('toit');
        $toit->display = 1;
        $toit->user_id = $user->id;

        $toit->save();
        return redirect('/feed');
    }

    function profile($username) {
        $context['user'] = User::where('name', $username)->first();
        if(!$context['user']) {
            $errors['error_text'] = "User $username not found";
            return view('toeat.errors.error', $errors);
        }
        $context['toits'] = $context['user']->toits->where('display', 1);

        return view('toeat.profile', $context);
    }
}
