<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\Favorite;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Category $cat) {
        $topBanner = Banner::getBanner()->first();
        $gallerys = Banner::getBanner('gallery')->get();
        $news_products = Product::orderBy('created_at', 'DESC')->limit(2)->get();
        $sale_products = Product::orderBy('created_at', 'DESC')->where('sale_price','>', 0)->limit(3)->get();
        $feature_products = Product::inRandomOrder()->limit(4)->get();
        $lastest_news = Blog::orderBy('created_at', 'DESC')->limit(3)->get();
        
        $key = request('keyword');
        if($key){
            $news_products = Product::orderBy('created_at', 'DESC')->limit(3)->get();
            $products = Product::where('name', 'LIKE', '%'.$key.'%')->paginate();
            return view('home.category', compact('products', 'cat', 'news_products'));
        }

        return view('home.index', compact('topBanner','gallerys','news_products','sale_products','feature_products', 'lastest_news'));
    }
    public function category (Category $cat)   {
        $products = Product::myFillter()->paginate(9);

        // $products = Product::paginate(9);
        if($cat->id){
            $products = $cat->products()->paginate(9);
        }
        // $key = request('keyword');
        // if($key){
        //     $products = Product::where('name', 'LIKE', '%'.$key.'%')->paginate();
        // }
        $news_products = Product::orderBy('created_at', 'DESC')->limit(3)->get();
        return view('home.category', compact('cat','products','news_products'));
    }

    public function product (Product $product, Category $cat)  {
        $key = request('keyword');
        if($key){
            $news_products = Product::orderBy('created_at', 'DESC')->limit(3)->get();
            $products = Product::where('name', 'LIKE', '%'.$key.'%')->paginate();
            return view('home.category', compact('products', 'cat', 'news_products'));
        }
        $related_prd = Product::paginate();
        $products = Product::where('category_id', $product->category_id)->limit(12)->get();
        return view('home.product', compact('product','products', 'related_prd')); 
    }

    
    public function favorite ($product_id, Category $cat)  {
        $data = [
            'product_id' => $product_id,
            'customer_id' => auth('cus')->id()
        ];


        $key = request('keyword');
        if($key){
            $news_products = Product::orderBy('created_at', 'DESC')->limit(3)->get();
            $products = Product::where('name', 'LIKE', '%'.$key.'%')->paginate();
            return view('home.category', compact('products', 'cat', 'news_products'));
        }

        $favorited = Favorite::where(['product_id' => $product_id, 'customer_id' => auth('cus')->id()])->first();
        if($favorited) {
            $favorited->delete();
            return redirect()->back()-> with('ok','Bạn đã bỏ yêu thích sản phẩm');

        } else {
            Favorite::create($data);
            return redirect()->back()-> with('ok','Bạn đã yêu thích sản phẩm');
        }



    }

    public function contact(Category $cat) {
        $key = request('keyword');
        if($key){
            $news_products = Product::orderBy('created_at', 'DESC')->limit(3)->get();
            $products = Product::where('name', 'LIKE', '%'.$key.'%')->paginate();
            return view('home.category', compact('products', 'cat', 'news_products'));
        }
        return view('home.contact');
    }
    public function post_contact(Request $request) {
        $request->validate([
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|min:6|max:100',
            'subject' => 'required|min:4',
            'message' => 'required|min:4'
        ]);
        $data = $request->all('name', 'email', 'subject', 'message');

        if (Contact::create($data)) {
            return redirect()->route('home.contact')->with('ok','Contact successfully, please wait for a response from us !!');
        }else{
            return redirect()->back()->with('no','Something error, Please try again');
        }

        return view('home.contact');
    }
    public function our_blog(Category $cat) {
        $key = request('keyword');
        if($key){
            $news_products = Product::orderBy('created_at', 'DESC')->limit(3)->get();
            $products = Product::where('name', 'LIKE', '%'.$key.'%')->paginate();
            return view('home.category', compact('products', 'cat', 'news_products'));
        }
        $blogs = Blog::paginate();
        return view('home.our_blog', compact('blogs'));
    }
    public function blog_details(Blog $blog, Category $cat) {
        $key = request('keyword');
        if($key){
            $news_products = Product::orderBy('created_at', 'DESC')->limit(3)->get();
            $products = Product::where('name', 'LIKE', '%'.$key.'%')->paginate();
            return view('home.category', compact('products', 'cat', 'news_products'));
        }
        $comments = Comment::where('blog_id', $blog->id)->orderBy('id', 'DESC')->get();
        return view('home.blog_details', compact('blog','comments'));
    }
    public function services_details(Category $cat) {
        $key = request('keyword');
        if($key){
            $news_products = Product::orderBy('created_at', 'DESC')->limit(3)->get();
            $products = Product::where('name', 'LIKE', '%'.$key.'%')->paginate();
            return view('home.category', compact('products', 'cat', 'news_products'));
        }
        return view('home.services_details');
    }
    public function services(Category $cat) {
        $key = request('keyword');
        if($key){
            $news_products = Product::orderBy('created_at', 'DESC')->limit(3)->get();
            $products = Product::where('name', 'LIKE', '%'.$key.'%')->paginate();
            return view('home.category', compact('products', 'cat', 'news_products'));
        }
        return view('home.services');
    }
    public function team_details(Category $cat) {
        $key = request('keyword');
        if($key){
            $news_products = Product::orderBy('created_at', 'DESC')->limit(3)->get();
            $products = Product::where('name', 'LIKE', '%'.$key.'%')->paginate();
            return view('home.category', compact('products', 'cat', 'news_products'));
        }
        return view('home.team_details');
    }

    public function post_comment (Request $request, $BolgId) {
        $request->validate([
            'comment' => 'required|min:6|max:1000',
        ]);
        $data = request()->all('comment');
        $data['blog_id'] = $BolgId;
        $data['customer_id'] = auth('cus')->id();
        if (Comment::create($data)) {
            return redirect()->back();
        }
        return redirect()->back();
    }


    public function delete_comment($id) {
        $comment = Comment::find($id);
    
        if (!$comment) {
            return redirect()->back()->with('no', 'Comment not found.');
        }
    
        // Kiểm tra nếu người dùng đã đăng nhập và là chủ của comment
        if (Auth::guard('cus')->id() !== $comment->customer_id) {
            return redirect()->back()->with('no', 'You can only delete your own comments.');
        }
    
        $comment->delete();
        return redirect()->back()->with('ok', 'Comment deleted successfully.');
    }
    
    public function edit_comment($id) {
        $comment = Comment::find($id);
    
        if (!$comment) {
            return redirect()->back()->with('no', 'Comment not found.');
        }
    
        // Kiểm tra nếu người dùng đã đăng nhập và là chủ của comment
        if (Auth::guard('cus')->id() !== $comment->customer_id) {
            return redirect()->back()->with('no', 'You can only edit your own comments.');
        }
    
        return view('home.edit_comment', compact('comment'));
    }
    
    public function update_comment(Request $request, $id) {
        $comment = Comment::find($id);
    
        if (!$comment) {
            return redirect()->route('home.blog_details', ['blog' => $comment->blog_id])->with('no', 'Comment not found.');
        }
    
        // Kiểm tra nếu người dùng đã đăng nhập và là chủ của comment
        if (Auth::guard('cus')->id() !== $comment->customer_id) {
            return redirect()->route('home.blog_details', ['blog' => $comment->blog_id])->with('no', 'You can only edit your own comments.');
        }
    
        $comment->comment = $request->input('comment');
        $comment->save();
    
        return redirect()->route('home.blog_details', ['blog' => $comment->blog_id])->with('ok', 'Comment updated successfully.');
    }
}
