<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Blog::myFillter()->paginate(12);
        return view('admin.blog.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4|max:150',
            'description' => 'required|min:4',
            'link' => 'required',
        ]);
        $data = $request->only('name', 'link', 'description', 'position', 'status');
        $imgname = $request->img->hashName();
        $request->img->move(public_path('uploads/blog'), $imgname);
        $data['image'] = $imgname;
        if (Blog::create($data)) {
            return redirect()->route('blog.index')->with('ok', 'Create new blog successffuly');
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
    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required|min:4|max:150',
            'description' => 'required|min:4',
            'link' => 'required',
        ]);
        $data = $request->only('name', 'link', 'description', 'position', 'status');

        if ($request->has('img')) {
            $img_name = $blog->image;
            $image_path = public_path('uploads/blog').'/'.$img_name;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $imag_name = $request->img->hashName();
            $request->img->move(public_path('uploads/blog'), $imag_name);
            $data['image'] = $imag_name;
        }

        if ($blog->update($data)) {
            return redirect()->route('blog.index')->with('ok', 'Update new blog successffuly');
        } else {
            return redirect()->back()->with('no', 'Something error, Please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $img_name = $blog->image;
        $image_path = public_path('uploads/blog').'/'.$img_name;
        if ($blog->delete()) {
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            return redirect()->route('blog.index')->with('ok','Delete product successffuly');
        }else{
            return redirect()->back()->with('no','Something error, Please try again');
        }
    }
}
