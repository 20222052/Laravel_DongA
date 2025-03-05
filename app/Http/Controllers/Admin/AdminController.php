<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $count_contact = Contact::where('status', 0)->count();
        $count_order = Order::where('status', 0)->count();
        $count_comment = Comment::whereDate('created_at', Carbon::today())->count();
        $count_user = User::whereDate('created_at', Carbon::today())->count();
        return view('admin.index', compact('count_contact', 'count_order', 'count_comment', 'count_user'));
    }

    public function login() {
       // dd('dssdfd');
        return view('admin.login');
    }

    public function check_login(Request $req) {
        $req->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $data = $req->only('email','password');

        $check = auth()->attempt($data);

        if ($check) {
            return redirect()->route('admin.index')->with('ok','Welcom Back');
        }

        return redirect()->back()->with('no','Your email Or Password is not match');
    }

    public function logout() {
        auth()->logout();
        return redirect()->route('admin.login')->with('no','Logouted');
    }
}
