<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Str;

class ApiCategoryController extends Controller
{
    public function index() {
        $cats = Category::all();
        return response()->json($cats);
    }

    public function destroy(Category $category) {

        return [
            'success' => $category->delete()
        ];
    }

    public function store() {
        $data = request()->all('name','status');
        return Category::create($data);
    }

    public function show(Category $category) {
        return $category;
    }

    public function update(Category $category) {
        $data = request()->all('name','status');
        return [
            'success' => $category->update($data)
        ];
    }

    public function login(Request $req) {

        $data = $req->only('email','password');

        $check = auth()->attempt($data);

        if ($check) {
            // tạo mã token gửi về cho client
            $user = auth()->user();
            $token = $user->createToken(Str::slug($user->name));

            return [
                'token' => $token->plainTextToken
            ];
        }

        return ['success' => false];

    }
}
