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
           
        return view('index' ,compact('products')); 
    }
    
    public function profile(Request $request)
    {
        
        // ユーザーを更新
        $user = User::find($request->id);
        if ($user) {
            $user->update([
                'name' => $request->name,
            ]);
        }
        // プロフィールデータの準備
        $profiles = [
            'user_id' => Auth::id(),
            'image' => $request->image,
            // 'image' => $request->hasFile('image') ? $request->file('image')->store('profile_images', 'public') : null,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'building' => $request->building ?? '未設定',
        ];
        // データベースに保存
        Profile::create($profiles);
        return redirect('/');
    }
    public function uploadImage(Request $request)
    {
        // バリデーション
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048', // JPEG, PNG形式のみ
        ]);

        // ファイルを保存
        $path = $request->file('image')->store('uploads', 'public');

        // 保存した画像のパスをセッションに保存
        return redirect()->route('profile')->with('imagePath', $path);
    }
    public function item($id)
    {
        $products = Product::with('categories')->findOrFail($id);
        $isLiked = $products->likes()->where('user_id', auth()->id())->exists();
        return view('item', compact('products','isLiked'));
        
    }
    public function itemstore(Request $request)
    {
        
        $productId = $request->product_id; // フォームから送信されるproduct_id
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
    public function comment(Request $request)
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
        $userId = Auth::id();
        $products = Product::all();
        $profile = Profile::with('user')->where('user_id', $userId)->first();
        return view('mypage', compact('products', 'profile'));
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
}
