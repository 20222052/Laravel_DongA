<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Mail\VerifyAccount;
use App\Models\Customer;
use App\Models\CustomerResetToken;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Mail;
use Hash;

class AccountController extends Controller
{
    public function login() {
        return view('account.login');
    }

    public function favorite() {
        $favorites = auth('cus')->user()->favorites ? auth('cus')->user()->favorites : [];
        return view('account.favorite', compact('favorites'));
    }
    public function logout() {
        auth('cus')->logout();
        return redirect()->route('account.login')->with('ok','Your logouted');
    }

    public function check_login(Request $req) {
        $req->validate([
            'email' => 'required|exists:customers',
            'password' => 'required'
        ]);

        $data = $req->only('email','password');

        $check = auth('cus')->attempt($data);

        if ($check) {
            if (auth('cus')->user()->email_verified_at == '') {
                auth('cus')->logout();
                return redirect()->back()->with('no','You account is not verify, please check email again');
            }

            return redirect()->route('home.index')->with('ok','Welcome back');
        }
        return redirect()->back()->with('no','Your account or password invalid');
    }

    public function register() {
        return view('account.register');
    }

    public function check_register(Request $request) {
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|min:6|max:100|unique:customers',
            'phone' => 'required|digits_between:9,12',
            'address' => 'required|min:6|max:255',
            'gender' => 'required|in:0,1',
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password',
        ]);

        $data = $request->only('name','email','phone','address','gender');

        $data['password'] = bcrypt($request->password);

        if ($acc = Customer::create($data) ) {
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('account.login')->with('ok','Register successfully, please check your email to verify account');
        }
        return redirect()->back()->with('no','Smething error, please try again');
    }

    public function veryfy($email) {
        $acc = Customer::where('email', $email)->whereNUll('email_verified_at')->firstOrFail();
        Customer::where('email', $email)->update(['email_verified_at' => date('Y-m-d')]);
        return redirect()->route('account.login')->with('ok','erify account successfully, Now you can login');
    }

    public function change_password() {
        return view('account.change_password');
    }

    public function check_change_password(Request $req) {
        $auth = auth('cus')->user();
        $req->validate([
            'old_password' => [
                'required',
                function($attr, $value, $fail) use($auth)  {

                    if (!Hash::check($value, $auth->password) ) {
                        $fail('Your password is not match');
                    }
                }],
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password'
        ]);

        $data['password'] = bcrypt($req->password);
        $check = $auth->update($data);
        if ($check) {
            auth('cus')->logout();
            return redirect()->route('account.login')->with('ok','Update your password successfuly');
        }
        return redirect()->back()->with('no','Something error, please check agian');

    }

    public function forgot_password() {
        return view('account.forgot_password');
    }

    public function check_forgot_password(Request $req) {
        $req->validate([
            'email' => 'required|exists:customers'
        ]);

        $customer = Customer::where('email', $req->email)->first();

        $token = \Str::random(50);
        $tokenData = [
            'email' => $req->email,
            'token' => $token
        ];

        if (CustomerResetToken::create($tokenData)) {
            Mail::to($req->email)->send(new ForgotPassword($customer, $token));
            return redirect()->back()->with('ok','Send email successfully, please check email to continue');
        }

        return redirect()->back()->with('no','Something error, please check agian');

    }

    public function profile() {
        $auth = auth('cus')->user();
        return view('account.profile', compact('auth'));
    }
    //profile
    public function profilemain() {
        $auth = auth('cus')->user();
        return view('account.profilemain', compact('auth'));
    }
    public function check_profilemain(Request $req) {
        $auth = auth('cus')->user();
        $req->validate([
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|min:6|max:100|unique:customers,email,'.$auth->id,
            'password' => ['required', function($attr, $value, $fail) use($auth) {
                if (!Hash::check($value, $auth->password)) {
                    return $fail('Your password í not mutch');
                }
            }],
        ], [
            'name.required' => 'Họ tên không được để tróng',
            'name.min' => 'Họ ten tối thiểu là 6 ký tự'
        ]);

        $data = $req->only('name','email','phone','address','gender');

        $check = $auth->update($data);
        if ($check) {
            return redirect()->back()->with('ok','Update your profile successfuly');
        }
        return redirect()->back()->with('no','Something error, please check agian');

    }

    //profile-main
    public function check_profile(Request $req) {
        $auth = auth('cus')->user();
        $req->validate([
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|min:6|max:100|unique:customers,email,'.$auth->id,
        ]);

        $data = $req->only('name','email','phone','address','gender');

        $check = $auth->update($data);
        if ($check) {
            return redirect()->route('account.profilemain')->with('ok','Update your profile successfuly');
        }
        return redirect()->back()->with('no','Something error, please check agian');

    }

    public function reset_password($token) {

        $tokenData = CustomerResetToken::checkToken($token);

        return view('account.reset_password');
    }

    public function check_reset_password($token) {
        request()->validate([
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password'
        ]);

        $tokenData = CustomerResetToken::checkToken($token);
        $customer = $tokenData->customer;

        $data = [
            'password' => bcrypt(request(('password')))
        ];

        $check = $customer->update($data);

        if ($check) {
            return redirect()->back()->with('ok','Update your password successfuly');
        }

        return redirect()->back()->with('no','Something error, please check agian');

    }
}
