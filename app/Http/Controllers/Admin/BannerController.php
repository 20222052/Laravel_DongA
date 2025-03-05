<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Banner::myFillter()->paginate(12);
        return view('admin.banner.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create');
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
        $data = $request->only('name', 'link', 'description', 'position', 'prioty', 'status');
        $imgname = $request->img->hashName();
        $request->img->move(public_path('uploads/banner'), $imgname);
        $data['image'] = $imgname;
        if (Banner::create($data)) {
            return redirect()->route('banner.index')->with('ok', 'Create new product successffuly');
            with('ok', 'Create new product successffuly');
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
    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'name' => 'required|min:4|max:150',
            'description' => 'required|min:4',
            'link' => 'required',
        ]);
        $data = $request->only('name', 'link', 'description', 'position', 'prioty', 'status');

        if ($request->has('img')) {
            $img_name = $banner->image;
            $image_path = public_path('uploads/banner').'/'.$img_name;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $imag_name = $request->img->hashName();
            $request->img->move(public_path('uploads/banner'), $imag_name);
            $data['image'] = $imag_name;
        }

        if ($banner->update($data)) {
            return redirect()->route('banner.index')->with('ok', 'Update new Banner successffuly');
        } else {
            return redirect()->back()->with('no', 'Something error, Please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $img_name = $banner->image;
        $image_path = public_path('uploads/banner').'/'.$img_name;
        if ($banner->delete()) {
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            return redirect()->route('banner.index')->with('ok','Delete product successffuly');
        }else{
            return redirect()->back()->with('no','Something error, Please try again');
        }
    }
}
