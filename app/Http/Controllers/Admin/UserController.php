<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $key = request('keyword');
            $data = User::orderBy('id','DESC')->paginate(20);
        if($key){
            $data = User::where('name', 'LIKE', '%'.$key.'%')->paginate();
        }
        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats = Category::orderBy('name','ASC')->select('id','name')->get();
        return view('admin.user.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:4|max:150',
            're_password' => 'required|min:4|max:150|same:password',
            'email' => 'required|email|unique:users'
        ]);

        $data = $request->only('name', 'email', 'role');
        $data['password'] = bcrypt($request->password);

        if (User::create($data)) {
            return redirect()->route('user.index')->with('ok','Create new product successffuly');
        }else{
            return redirect()->back()->with('no','Something error, Please try again');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:4|max:150',
            're_password' => 'required|min:4|max:150|same:password',
            'email' => 'required'
        ]);

        $data = $request->only('name', 'email', 'role');
        $data['password'] = bcrypt($request->password);

        if ($user->update($data)) {
            return redirect()->route('user.index')->with('ok','Create new product successffuly');
        }else{
            return redirect()->back()->with('no','Something error, Please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
            if($user->delete()){
                return redirect()->route('user.index')->with('ok','Create new product successffuly');
            }else {
                return redirect()->route('user.index')->with('no','Something error, Please try again');
            }
    }
}
