<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Customer::myFillter()->paginate(12);
        return view('admin.customer.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'password' => 'required|min:4|max:150',
            'email' => 'required|email',
            'phone' => 'required|min:9|max:10'
        ]);

        $data = $request->only('name', 'email', 'phone', 'address', 'gender');
        $data['password'] = bcrypt($request->password);
        if (Customer::create($data)) {
            return redirect()->route('customer.index')->with('ok', 'Create new customer successffuly');
        } else {
            return redirect()->back()->with('no', 'Something error, Please try again');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('admin.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:9|max:10'
        ]);

        $data = $request->only('name', 'email', 'phone', 'address', 'gender');
        if ($request->password) {
            $request->validate([
                'password' => 'required|min:4|max:150'
            ]);
            $data['password'] = bcrypt($request->password);
            if ($customer->update($data)) {
                return redirect()->route('customer.index')->with('ok', 'Update customer successffuly');
            } else {
                return redirect()->back()->with('no', 'Something error, Please try again');
            }
        }else {
            return redirect()->back()->with('no', 'Something error, Please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        if(Customer::where('id', $customer->id)){
            return redirect()->back()->with('no', 'Something error, Please try again');
        }else {
            $customer->delete();
            return redirect()->route('customer.index')->with('ok', 'Delete customer successffuly');
        }
    }
}
