<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    public function index()
    {
        $data = Blog::myFillter()->paginate(12);
        return view('admin.blog.index', compact('data'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    // public function store(Request $request)
    // {
    //     if ($request->blog_url == null && $request->blog_url == '') {
    //         $request->validate([
    //             'name' => 'required|min:4|max:150',
    //             'description' => 'required|min:4',
    //             'link' => 'required',
    //         ]);
    //         $data = $request->only('name', 'link', 'description', 'position', 'status');
    //         $imgname = $request->img->hashName();
    //         $request->img->move(public_path('uploads/blog'), $imgname);
    //         $data['image'] = $imgname;
    //         if (Blog::create($data)) {
    //             return redirect()->route('blog.index')->with('ok', 'Create new blog successffuly');
    //         } else {
    //             return redirect()->back()->with('no', 'Something error, Please try again');
    //         }
    //     } else {
    //         $request->validate([
    //             'name' => 'required|min:4|max:150',
    //             'description' => 'required|min:4',
    //         ]);
    //         $data = $request->only('name', 'link', 'description', 'position', 'status');

    //         // Tải ảnh từ URL về máy
    //         $imageUrl = $request->image;
    //         $imageContent = Http::get($imageUrl)->body();

    //         if ($imageContent) {
    //             // Đổi tên ảnh (lấy phần mở rộng từ URL)
    //             $ext = pathinfo(parse_url($imageUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
    //             $imgName = uniqid() . '.' . $ext;

    //             // Lưu ảnh vào thư mục public/uploads/blog
    //             Storage::disk('public')->put("uploads/blog/{$imgName}", $imageContent);

    //             // Gán tên ảnh vào dữ liệu
    //             $data['image'] = $imgName;
    //         }

    //         if (Blog::create($data)) {
    //             return redirect()->route('blog.index')->with('ok', 'Create new blog successffuly');
    //         } else {
    //             return redirect()->back()->with('no', 'Something error, Please try again');
    //         }
    //     }
    // }

    public function store(Request $request)
    {
        if ($request->blog_url != null) {
            $request->validate([
                'name' => 'required|min:4|max:150',
                'description' => 'required|min:4',
            ]);
            $data = $request->only('name', 'link', 'description', 'position', 'status');

            // Tải ảnh từ URL về máy
            $imageUrl = $request->image;
            $imageContent = Http::get($imageUrl)->body();

            if ($imageContent) {
                // Đổi tên ảnh (lấy phần mở rộng từ URL)
                $ext = pathinfo(parse_url($imageUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                $imgName = uniqid() . '.' . $ext;

                 // Lưu ảnh vào thư mục public/uploads/blog
                file_put_contents(public_path("uploads/blog/{$imgName}"), $imageContent);

                // Gán tên ảnh vào dữ liệu
                $data['image'] = $imgName;
            }

            if (Blog::create($data)) {
                return redirect()->route('blog.index')->with('ok', 'Create new blog successffuly');
            } else {
                return redirect()->back()->with('no', 'Something error, Please try again');
            }
        } else {
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
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

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
            $image_path = public_path('uploads/blog') . '/' . $img_name;
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

    public function destroy(Blog $blog)
    {
        $img_name = $blog->image;
        $image_path = public_path('uploads/blog') . '/' . $img_name;
        if ($blog->delete()) {
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            return redirect()->route('blog.index')->with('ok', 'Delete product successffuly');
        } else {
            return redirect()->back()->with('no', 'Something error, Please try again');
        }
    }
}
