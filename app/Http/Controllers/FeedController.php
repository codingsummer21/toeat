<?php

namespace App\Http\Controllers;

use App\Models\Toit;
use App\Models\User;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    function feed() {
        $user = auth()->user();
        $context['toits'] = $user->feed();
        return view('toeat.feed', $context);
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
        $user = auth()->user();
        $context['user'] = User::where('name', $username)->first();
        if(!$context['user']) {
            $errors['error_text'] = "User $username not found";
            return view('toeat.errors.error', $errors);
        }
        $context['toits'] = $context['user']->toits->where('display', 1);
        $context['followers'] = $context['user']->followers;
        $context['following'] = $context['user']->following;
        $context['is_current_user'] = $user->id == $context['user']->id;
        $context['unfollow'] = $context['followers']->contains($user);

        return view('toeat.profile', $context);
    }

    function follow($id) {
        $followingUser = User::find($id);
        if(!$followingUser) {
            $errors['error_text'] = "User with ID $id not found";
            return view('toeat.errors.error', $errors);
        }
        $user = auth()->user();
        $user->following()->attach($id);

        return redirect('/profile/' . $followingUser->name);
    }

    function unfollow($id) {
        $followingUser = User::find($id);
        if(!$followingUser) {
            $errors['error_text'] = "User with ID $id not found";
            return view('toeat.errors.error', $errors);
        }
        $user = auth()->user();
        $user->following()->detach($id);

        return redirect('/profile/' . $followingUser->name);
    }
}
