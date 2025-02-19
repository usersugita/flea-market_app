<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Like;
use App\Models\Profile;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;

use App\Models\Order;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class MarketController extends Controller
{
    public function index(Request $request)
    {     
        // セッションに登録リダイレクトフラグがあれば、リダイレクト先を変更
        if (session()->has('registration_redirect')) {
            session()->forget('registration_redirect'); // フラグを削除
                         
            return redirect('/profile'); // フラッシュデータとして渡す // 新規登録後のページ
        }
        $products = Product::all();
        $user = auth()->user();
        if ($user) {
            // ログインユーザーの「お気に入り」データを取得
            $likes = Like::with('product')->where('user_id', $user->id)->get();
            $orders = Order::with('product')->where('user_id', $user->id)->get();
        } else {
            // ログインしていない場合は、空のコレクションを返す
            $likes = collect();
            $orders = collect();
        }
        return view('index' ,compact('products', 'likes', 'orders')); 
    }
    
    public function profile(ProfileRequest $request)
    {
        $user = User::find($request->id);
        if ($user) {
            $user->update([
                'name' => $request->name,
            ]);
        }                   
            $profiles = [
                'user_id' => Auth::id(),
                'image' => $request->image,
                'postcode' => $request->postcode,
                'address' => $request->address,
                'building' => $request->building ?? '未設定',
            ];
            Profile::create($profiles);                          
            return redirect('/');
        
    }
    public function uploadImage(Request $request)
    {

        $path = $request->file('image')->store('uploads', 'public');


        return redirect()->back()->with('imagePath', $path);
    }
    public function item($id)
    {
        $products = Product::with('categories')->findOrFail($id);
        $isLiked = $products->likes()->where('user_id', auth()->id())->exists();
        $isPurchased = Order::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->exists();
        return view('item', compact('products','isLiked', 'isPurchased'));
        
    }
    public function itemstore(Request $request)
    {
        
        $productId = $request->product_id; 
        $userId = Auth::id();

        // 既にいいねしているか確認
        $like = Like::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($like) {
            // いいねを解除
            $like->delete();
            return redirect()->back()->with('success', 'いいねを外しました');
        } else {
            // いいねを追加
            Like::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);

            return redirect()->back()->with('success', 'いいねしました');
        }
    }
    public function comment(CommentRequest $request)
    {
            Comment::create([
                'comment' => $request->input('comment'),
                'user_id' => Auth::id(), // 現在のログインユーザーのID
                'product_id' => $request->input('product_id'),
            ]);
            return redirect()->back();
        }
    public function mypage()
    {
        $user = auth()->user(); 

        // ログインユーザーの購入履歴を取得
        $orders = Order::with('product')->where('user_id', $user->id)->get();
        $userId = Auth::id();
        $products = Product::all();
        $profile = Profile::with('user')->where('user_id', $userId)->first();
        return view('mypage', compact('products', 'profile', 'orders'));
    }


    public function sell()
    {
        $categories = Category::all();

        return view('sell', compact('categories'));
        
    }
    public function store(Request $request)
    {    
        $product = Product::create([
            'image' => $request->image,
            'condition' => $request->condition,
            'name' => $request->name,
            'description' => $request->description,
         'price' => $request->price,            
        ]);
        // カテゴリを中間テーブルに保存
        $product->categories()->attach($request->categories);

        return redirect();
    }
    public function search(Request $request)
    {
        // 検索クエリを生成
        $query = $this->getSearchQuery($request);

        // 検索結果を取得
        $products = $query->get();

        // ビューにデータを渡す
        return view('index', compact('products', 'request', ));
    }

    private function getSearchQuery($request)
    {
        // Productクラスのクエリビルダーを作成
        $query = Product::query();

        // キーワードが入力されている場合は条件を追加
        if (!empty($request->keyword)) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        return $query;
    }
    public function purchase($id)
    {
        
        $product = Product::findOrFail($id); 
        $user = auth()->user();
        $profile = $user->profile;  
        return view('purchase', compact('product', 'profile','id'));
    }
    public function order(Request $request)
    {
        $user = auth()->user(); // ログイン中のユーザー
        // $product = Product::findOrFail($productId); // 商品を取得
       
        Order::create([
            'user_id' => $user->id,           
            'product_id' => $request->product_id,
            'profile_id' => $request->profile_id,
        ]);

        return redirect('mypage');
    }
  
    public function address(Request $request,$id)
    {
        
        return view('address', compact('id'));
    }
    public function addresschange(ProfileRequest $request,$id)
    {
        $user = auth()->user();
        $profile = Profile::where('user_id', $user->id)->firstOrFail();

        $profile->update([
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect()->route('purchase', ['id' => $id])
            ;
    }
    public function updateImage(Request $request)
    {
        
        $path = $request->file('image')->store('uploads', 'public');
        
        
        return redirect()->back()->with('imagePath', $path);
        
    }
    public function myprofile()
    {     
         $profile = Profile::where('user_id', Auth::id())->first();
       
        return view('profileupdate', compact('profile'));
    }
    public function updateProfile(ProfileRequest $request)
    {
        $user = auth()->user(); // ログイン中のユーザー
        $profile = Profile::where('user_id', $user->id)->firstOrFail(); // ログインユーザーの
        // $user->update([
            // 'name' => $request->name,
        // ]);      
        $profiles = [
            'image' => $request->image,              
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building ?? '未設定',
        ];
        $profile->update($profiles);

        return redirect('mypage');
    }
    public function listing(Request $request)
    {
        $product = Product::create([
            'condition' => $request->condition,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image,
            'user_id' => auth()->id(), 
        ]);
        $product->categories()->attach($request->categories); 
        return redirect('mypage');
    }
}