<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = new Category;
        $key = request('keyword');
        $order = request('order');
        if($key){
            $query = $query->where('name', 'LIKE', '%'.$key.'%');
        }
        if($order){
            $arr = explode('-', $order);
            $query = $query->orderBy($arr[0], $arr[1]);  
        }
        $data = $query->paginate(20);
        return view('admin.category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4|max:150'
        ]);
        $data = request()->all('name','status');
        // dd($data);
        if (Category::create($data)){
            return redirect()->route('category.index')->with('ok','Create new product successffuly');
        }else {
            return redirect()->route('category.index')->with('no','Something error, Please try again');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|min:4|max:150'
        ]);
        $data =  request()->all('name','status');
        // dd($data);
        if ($category->update($data)){
            return redirect()->route('category.index')->with('ok','Create new product successffuly');
        }else {
            return redirect()->route('category.index')->with('no','Something error, Please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $Count = Product::where('category_id', $category->id)->count();
        if ($Count > 0){
            return redirect()->route('category.index')->with('no','Something error, Please try again');
        }else {
            if($category->delete()){
                return redirect()->route('category.index')->with('ok','Create new product successffuly');
            }else {
                return redirect()->route('category.index')->with('no','Something error, Please try again');
            }
        }
    }
}
